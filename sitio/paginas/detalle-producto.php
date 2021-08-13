<?php
/**
 * @var PDO $db;
 */
require_once __DIR__ . '/../clases/ProductoRepository.php';
$id = (int) $_GET['id'];
$repo = new ProductoRepository($db);
$producto = $repo->getByPk($id);
?>
<section id="detalle-producto">
    <h1>Detalle del producto</h1>
    <article>
        <div>
            <div id="detalle-imagen">
                <img src="img/<?= $producto->getImagen();?>" class="card-img-top" alt="<?= $producto->getImagenDescripcion();?>">
            </div>
            <div id="detalle-info">
                <h2><?= $producto->getNombre();?></h2>
                <div id="detalle-categorias">
                    <p>Categorias:</p>
                    <?php 
                        $productoCompleto = $repo->getByPk($producto->getProductoId(), true);
                        foreach($productoCompleto->getCategorias() as $categoria): ?>
                            <p class="card-text badge bg-category">
                                <?=$categoria->getNombre();?>
                            </p>
                        <?php
                        endforeach;
                    ?>
                </div> 
                <div id="detalle-descripcion">
                    <p>Descripcion</p>
                    <div>
                        <p><?= $producto->getDescripcion();?></p>
                    </div>
                </div>
                <p>Precio: $<?= $producto->getPrecio();?></p>
                <form action="acciones/item-carrito-agregar.php" method="post" class="form-item-agregar">
                    <input type="hidden" name="producto_id" value="<?= $producto->getProductoId();?>">
                    <button class="btn">Agregar al carrito</button>
                </form>
                
            </div>  
        </div>
        
    </article>
</section>
