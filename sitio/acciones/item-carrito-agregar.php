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


$producto_id = $_POST['producto_id'];
$cantidad = 1;
$usuario_id = $auth->getUsuario()->getUsuarioId();

$repo = new CarritoRepository($db);
$exito = $repo->create(array("cantidad"=>$cantidad, "producto_id"=>$producto_id, "usuario_id"=>$usuario_id));

if($exito) {
    $_SESSION['status_exito'] = '<div class="correcto"><p>El producto fue agregado al carrito.</p></div>';
} else {
    $_SESSIO['status_error'] = '<div class="erroneo"><p>El producto no se pudo agregar al carrito, por favor pruebe de nuevo.</p></div>';
}
header('Location: ./../index.php?s=menu');