<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Función para enviar correo
function enviarCorreo($to, $subject, $message, $headers) {
    return mail($to, $subject, $message, $headers);
}

// Recuperar los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];

// Configuración del correo electrónico
$to = $email; // Dirección de correo del destinatario (usuario)
$subject = 'Confirmación de Inscripción'; // Asunto del correo
$message = "
<html>
<head>
  <title>Confirmación de Inscripción</title>
</head>
<body>
  <p>Hola $nombre,</p>
  <p>Gracias por realizar su preinscripción.</p>
  <br>
  <p><b>Por favor</b>, lea atentamente y luego <b>responda este correo</b> con la informacion solicitada.</p>
  <p>Ud. Se encuentra preinscripto a <b>FAAPI 2024 - Virtual Edition</b></p>
  <br>
  </body>
</html>
";

// Cabeceras del correo electrónico desde la primera dirección
$headers1 = [
    'MIME-Version: 1.0',
    'Content-type: text/html; charset=utf-8',
    'From: ',
    'Reply-To: ',
    'X-Mailer: PHP/' . phpversion()
];

// Cabeceras del correo electrónico desde la segunda dirección
$headers2 = [
    'MIME-Version: 1.0',
    'Content-type: text/html; charset=utf-8',
    'From: ', 
    'Reply-To: ', 
    'X-Mailer: PHP/' . phpversion()
];

// Convertir cabeceras a formato string
$headers_str1 = implode("\r\n", $headers1);
$headers_str2 = implode("\r\n", $headers2);

// Intentar enviar el correo desde la primera dirección
if (enviarCorreo($to, $subject, $message, $headers_str1)) {
    echo json_encode(['success' => true, 'sent_from' => '']);
} else {
    // Si falla, intentar enviar desde la segunda dirección
    if (enviarCorreo($to, $subject, $message, $headers_str2)) {
        echo json_encode(['success' => true, 'sent_from' => '']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Ambos intentos de envío fallaron']);
    }
}
?>