<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre_contacto']);
    $email = htmlspecialchars($_POST['email_contacto']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    $to = "";
    $subject = "Nuevo mensaje de contacto de " . $nombre;
    $body = "Nombre: $nombre\nEmail: $email\n\nMensaje:\n$mensaje";
    $headers = [
        "From: noreply@tu-dominio.com",
        "Reply-To: $email", // Usar Reply-To con el email del remitente
        "MIME-Version: 1.0",
        "Content-type: text/plain; charset=utf-8"
    ];

    $headers_str = implode("\r\n", $headers);

    if (mail($to, $subject, $body, $headers_str)) {
        echo '<script>alert("Mensaje enviado correctamente. Pronto nos pondremos en contacto.");';
        echo 'window.location.href = "index.php";</script>';
        exit;
    } else {
        echo "Hubo un problema al enviar el mensaje.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>