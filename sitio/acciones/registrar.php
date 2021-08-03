<?php
session_start();
ini_set ("SMTP","localhost");
ini_set ("sendmail_from","shopveggie0@gmail.com");
require_once __DIR__ . '/../boostrap/autoload.php';
require_once __DIR__ . '/../boostrap/conexion.php';
$email      = $_POST['email'];
$password   = $_POST['password'];


$repo = new UsuarioRepository($db);
$exito = $repo->crear([
    'email' => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'rol_id' => 2,
]);

if($exito) {
    $envioEmail = new Email($email, 'Gracias por registrarse en Natural');
    $envioEmail->cargar('bienvenido.php', ['@@email@@' => $email]);
    $envioEmail->send();
    $_SESSION['status_exito'] = '<div class="correcto"><p>Se ha registrado con exito.</p></div>';
    header("Location: ../index.php?s=iniciar-sesion");
} else{
    $_SESSION['status_error'] = '<div class="erroneo"><p>No se pudo registrar, vuelva a intentarlo.</p></div>';
    $_SESSION['oldData'] = $_POST;
    header("Location: ../index.php?s=registrarse");
}
