<?php
/**
 * @var PDO $db
 */
session_start();
require_once __DIR__ . '/../boostrap/conexion.php';
require_once __DIR__ . '/../boostrap/autoload.php';

$auth = new Autenticacion($db);
if(!$auth->autenticado()) {
    $_SESSION['status_error'] = '<div class="erroneo">Se require iniciar sesion para realizar esta acción.</p></div>';
    header("Location: index.php?s=iniciar-sesion");
    exit;
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$calle = $_POST['calle'];
$numero = $_POST['numero'];
$codigo_postal = $_POST['codigo_postal'];
$dpto = $_POST['dpto'];
$usuario_id = $auth->getUsuario()->getUsuarioId();

$repo = new UsuarioRepository($db);
$exito = $repo->updateConDireccion($usuario_id, $nombre, $apellido, $telefono, $calle, $numero, $codigo_postal, $dpto);


if($exito) {
    $_SESSION['status_exito'] = '<div class="correcto"><p>El perfil fue actualizado.</p></div>';
} else {
    $_SESSIO['status_error'] = '<div class="erroneo"><p>El perfil no se pudo actualizar, por favor pruebe de nuevo.</p></div>';
}
header('Location: ./../index.php?s=perfil');