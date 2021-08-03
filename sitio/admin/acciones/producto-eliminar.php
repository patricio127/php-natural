<?php
/**
 * @var PDO $db
 */
session_start();
require_once __DIR__ . '/../../boostrap/conexion.php';
require_once __DIR__ . '/../../boostrap/autoload.php';

$auth = new Autenticacion($db);
if(!$auth->autenticado()) {
    $_SESSION['status_error'] = '<div class="erroneo">Se require iniciar sesion para realizar esta acción.</p></div>';
    header("Location: index.php?s=iniciar-sesion");
    exit;
}


$id = $_POST['producto_id'];

$repo = new ProductoRepository($db);
$exito = $repo->delete($id);

if($exito) {
    $_SESSION['status_exito'] = '<div class="correcto"><p>El producto fue eliminado con éxito.</p></div>';
} else {
    $_SESSIO['status_error'] = '<div class="erroneo"><p>El producto no se pudo eliminar, por favor pruebe de nuevo.</p></div>';
}
header('Location: ./../index.php?s=menu');