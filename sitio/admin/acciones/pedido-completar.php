<?php
session_start();

require_once __DIR__ . '/../../boostrap/autoload.php';
require_once __DIR__ . '/../../boostrap/conexion.php';

$autenticacion = new Autenticacion($db);

$id = $_POST['id'];
$completado = $_POST['completado'];

$repo = new PedidoRepository($db);
$exito = $repo->updateEstadoPedido($id, $completado);

if($exito) {
    $_SESSION['status_exito'] = '<div class="correcto"><p>El estado fue modificado con éxito.</p></div>';
} else {
    $_SESSIO['status_error'] = '<div class="erroneo"><p>El estado no se pudo modificar, por favor pruebe de nuevo.</p></div>';
}
header('Location: ./../index.php?s=detalle-pedido&id='.$id);