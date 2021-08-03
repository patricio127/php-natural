<?php
session_start();

require_once __DIR__ . '/../../boostrap/autoload.php';
require_once __DIR__ . '/../../boostrap/conexion.php';

$autenticacion = new Autenticacion($db);

$autenticacion ->logout();

$_SESSION['status_exito'] = '<div class="correcto"><p>sesión cerrada correctamente.</p></div>';
header('Location: ../index.php?s=iniciar-sesion');