<?php
session_start();
require_once __DIR__ . '/../../boostrap/autoload.php';
require_once __DIR__ . '/../../boostrap/conexion.php';

$email      = $_POST['email'];
$password   = $_POST['password'];

$authenticacion = new Autenticacion($db);

if($authenticacion->login($email, $password)) {
    $_SESSION['status_exito'] = '<div class="correcto"><p>Inicio de sesión correctamente.</p></div>';
    header('Location: ../index.php?s=inicio');
    exit;
} else {
    $_SESSION['status_error'] = '<div class="erroneo"><p>Email o contraseña incorrecta.</p></div>';
    $_SESSION['oldData'] = $_POST;
    header('Location: ../index.php?s=iniciar-sesion');
    exit;
}