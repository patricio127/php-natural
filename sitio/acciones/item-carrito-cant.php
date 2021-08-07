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


$id = $_POST['id'];
$cantidad = $_POST['cantidad'];

$repo = new CarritoRepository($db);
$exito = $repo->update($id, $cantidad);

if($exito) {
    $_SESSION['status_exito'] = '<div class="correcto"><p>El item del carrito fue actualizado.</p></div>';
} else {
    $_SESSIO['status_error'] = '<div class="erroneo"><p>No se pudo actualizar el item del carrito, por favor pruebe de nuevo.</p></div>';
}
header('Location: ./../index.php?s=carrito');