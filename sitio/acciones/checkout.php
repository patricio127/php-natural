<?php
session_start();

require_once __DIR__ . '/../boostrap/autoload.php';
require_once __DIR__ . '/../boostrap/conexion.php';

$auth = new Autenticacion($db);
if(!$auth->autenticado()) {
    $_SESSION['status_error'] = '<div class="erroneo">Se require iniciar sesion para realizar esta acción.</p></div>';
    header("Location: index.php?s=iniciar-sesion");
    exit;
}

$usuario_id         = $auth->getUsuario()->getUsuarioId();
$exito       = false;
$repoCarrito = new CarritoRepository($db);
$repoPedido = new PedidoRepository($db);
$repoUsuario = new UsuarioRepository($db);
$repoPedidoItem = new PedidoItemRepository($db);

$carritoItems = $repoCarrito->getByUserId($usuario_id);
if(count($carritoItems) == 0) {
    exit;
    $_SESSION['status_error'] = '<div class="erroneo"><p>No hay items en el carrito.</p></div>';
    header("Location: ../index.php?s=carrito");
};

$monto_productos      = $_POST['monto_productos'];
$monto_envio          = $_POST['monto_envio'];
$monto_total          = $_POST['monto_total'];
$fecha                = date("Y/m/d");
$delivery             = $_POST['delivery'];

$nombre             = $_POST['nombre'];
$apellido           = $_POST['apellido'];
$telefono           = $_POST['telefono'];



if(isset($_POST['calle'])) {
    $calle              = $_POST['calle'];
    $numero             = $_POST['numero'];
    $codigo_postal      = $_POST['codigo_postal'];
    $dpto               = $_POST['dpto'];

    $exito = $repoUsuario->updateConDireccion($usuario_id, $nombre, $apellido, $telefono, $calle, $numero, $codigo_postal, $dpto);
} else {
    $exito = $repoUsuario->update($usuario_id, $nombre, $apellido, $telefono);
}

if($exito) {
    $id_pedido = $repoPedido->create(array( 
        'monto_total'            => $monto_total,
        'monto_envio'            => $monto_envio,
        'monto_productos'        => $monto_productos , 
        'fecha'                  => $fecha, 
        'delivery'               => $delivery , 
        'usuario_id'             => $usuario_id, 
        ));
    if($id_pedido) {
        foreach($carritoItems as $itemCarrito) {
            $exito = $repoPedidoItem->create(array( 
                'cantidad'         => $itemCarrito->getCantidad(),
                'precio'           => $itemCarrito->getPrecio(),
                'pedido_id'        => $id_pedido, 
                'producto_id'      => $itemCarrito->getProducto_id(), 
            ));
        }
    }
    if($exito) {
        $repoCarrito->vaciar($usuario_id);
    }
}

if($exito) {
    $_SESSION['status_exito'] = '<div class="correcto"><p>Pedido realizado correctamente.</p></div>';
    header("Location: ../index.php?s=gracias");
} else{
    $_SESSION['status_error'] = '<div class="erroneo"><p>No se pudo realizar la compra.</p></div>';
    header("Location: ../index.php?s=carrito");
}