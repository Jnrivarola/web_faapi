<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

session_start();

$servername = "localhost";
$username = "politecn_root";
$password = ".Politecnico2024";
$dbname = "politecn_faapi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['nombre'], $_SESSION['apellido'], $_SESSION['dni'], $_SESSION['email'], $_SESSION['celular'], $_SESSION['residencia'], $_SESSION['tipo'])) {
    $nombre = $conn->real_escape_string($_SESSION['nombre']);
    $apellido = $conn->real_escape_string($_SESSION['apellido']);
    $dni = $conn->real_escape_string($_SESSION['dni']);
    $email = $conn->real_escape_string($_SESSION['email']);
    $celular = $conn->real_escape_string($_SESSION['celular']);
    $residencia = $conn->real_escape_string($_SESSION['residencia']);
    $tipo = $conn->real_escape_string($_SESSION['tipo']);

    $sql = "INSERT INTO inscripciones (nombre, apellido, dni, email, celular, residencia, tipo) 
            VALUES ('$nombre', '$apellido', '$dni', '$email', '$celular', '$residencia', '$tipo')";

if ($conn->query($sql) === TRUE) {
        session_unset();
        session_destroy();
        header("Location: confirmacion.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Datos de sesion no encontrados.";
}

$conn->close();
?>         