<?php
$auth = new Autenticacion($db);
$usuario_id = $auth->getUsuario()->getUsuarioId();
$repo = new CarritoRepository($db);
$items_carrito = $repo->getByUserId($usuario_id);
?>
<section>
    <h1>Carrito</h1>
    <ul>
    <?php
    if(count($items_carrito) > 0):
        foreach($items_carrito as $item):
        ?>
        <li>
            <?=$item->getId();?>
            <?=$item->getProducto_id();?>
            <?=$item->getCantidad();?>
            <?=$item->getNombre();?>
            <?=$item->getDescripcion();?>
            <?=$item->getPrecio();?>
            <form action="acciones/item-carrito-quitar.php" method="post" class="form-item-quitar">
                <input type="hidden" name="id" value="<?= $item->getId();?>">
                <button class="btn">Quitar</button>
            </form>
        </li>
    <?php
        endforeach;
    endif;
    ?>
    </ul>
</section>