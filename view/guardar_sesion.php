<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['nombre'] = $_POST['nombre'];
    $_SESSION['apellido'] = $_POST['apellido'];
    $_SESSION['dni'] = $_POST['dni'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['celular'] = $_POST['celular'];
    $_SESSION['residencia'] = $_POST['residencia'];
    $_SESSION['tipo'] = $_POST['tipo'];

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>