<?php
/**
 * @var PDO $db;
 */
require_once __DIR__ . '/../../clases/PedidoRepository.php';
$id = (int) $_GET['id'];
$repo = new PedidoRepository($db);
$pedido = $repo->getById($id);
$pedido_items =  $pedido->getItems();
?>
<section id="detalle-pedido">
    <h1>Detalle del pedido</h1>
    <p>Fecha: <?= $pedido->getFecha();?></p>
    <p>Tipo: <?= ($pedido->getDelivery()) ? "Delivery" : "Take Away";?></p>
    <p>Monto productos: $ <?=$pedido->getMonto_productos();?></p>
    <p>Monto envio: $ <?=$pedido->getMonto_envio();?></p>
    <p>Monto Total: $ <?=$pedido->getMonto_total();?></p>
    <p class="estado <?=($pedido->getCompletado()) ? "badge bg-success" : "badge bg-warning text-dark";?>">Estado: <?=($pedido->getCompletado()) ? "Completado" : "En proceso";?></p>
    <?php
        if($pedido->getCompletado() == 0): ?>
    <form action="acciones/pedido-completar.php" method="post" class="form-pedido-completar">
        <input type="hidden" name="id" value="<?= $pedido->getPedido_id();?>">
        <input type="hidden" name="completado" value="1">
        <button class="btn">Marcar como entregado</button>
    </form>
    <?php
        endif; ?>
    <table>
        <thead class="container">
            <tr>
                <th class="col-2">Imagen</th>
                <th class="col-2">Nombre</th>
                <th class="col-4">Descripción</th>
                <th class="col-1 precio">Precio</th>
                <th class="col-1">Cantidad</th>
                <th class="col-2 precio">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($pedido_items as $item): ?>
            <tr>
                <td class="col-2 admin-imagen"><img src="<?= '../img/' . $item->getImagen();?>" alt="<?= $item->getImagen_descripcion();?>"></td>
                <td class="col-2"><?=$item->getNombre();?></td>
                <td class="col-4"><?=$item->getDescripcion();?></td>
                <td class="col-1 precio">$ <?=$item->getPrecio();?></td>
                <td class="col-1"><?=$item->getCantidad();?></td>
                <td class="col-2 precio">$ <?=($item->getPrecio())*($item->getCantidad());?></td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</section>