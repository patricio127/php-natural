<?php
/** @var PDO $db */
require_once __DIR__ . '/../clases/ProductoRepository.php';
$buscar = $_GET['buscar'] ?? null;
$busqueda = [];
if($buscar) {
    $busqueda['buscar'] = $buscar;
}

$paginaActual = (int) ($_GET['p'] ?? 1);

$repo = new ProductoRepository($db);
$repo->paginacionHabilitar();
$repo->setPaginacionPagina($paginaActual);
$productos = $repo->all($busqueda);
?>
<section id="menu">
    <h1>Catálogo del producto</h1>
    <div>
        <form action="index.php" method="get" class="buscar d-flex">
            <input type="hidden" name="s" value="menu">
            <div>
                <input class="form-control me-2" type="search" name="buscar" id="buscar" value="<?= $buscar; ?>" placeholder="Buscar productos">
            </div>
            <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
    </div>
    <div class="row" >
    <?php
    if(count($productos) > 0):
        foreach($productos as $producto):
        ?>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <a href="index.php?s=detalle-producto&id=<?= $producto->getProductoId();?>" class="col-3">
                    <article class="card ">
                        <div class="card-body" >
                            <h2 class="card-title"><?= $producto->getNombre();?></h2>
                            <div>
                                <div class="categorias">
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
                                <p class="precio card-text">$<?= $producto->getPrecio();?></p>
                            </div> 
                        </div>  
                        <picture>
                            <source srcset="<?='img/' . $producto->getImagen();?>" class="card-img-top" media="(min-width: 780px)"> 
                            <img src="<?='img/' . $producto->getImagen();?>" class="card-img-top" alt="<?= $producto->getImagenDescripcion();?>">
                        </picture>
                    </article>
                </a>
                <form action="acciones/item-carrito-agregar.php" method="post" class="form-item-agregar">
                    <input type="hidden" name="producto_id" value="<?= $producto->getProductoId();?>">
                    <button class="btn">Agregar al carrito</button>
                </form>
            </div>
            
        <?php
        endforeach;
        ?>
        <?php
        if($repo->isPaginacionHabilitada() && $repo->getPaginacionTotalPaginas() > 1):?>
            <div class="paginacion">
                <p>Páginas</p>
                <ul>
                <?php 
                    for($p = 1; $p <= $repo->getPaginacionTotalPaginas(); $p ++): ?>
                        <li>
                            <?php
                            if($p !== $paginaActual):
                            ?>
                                <a href="index.php?s=menu&buscar=<?= $buscar; ?>&p=<?= $p; ?>">
                                    <?= $p; ?>
                                </a>
                            <?php
                            else:
                            ?>
                                <span><?= $p; ?></span>
                            <?php
                            endif;
                            ?>
                            
                        </li>
                    <?php
                    endfor;
                ?>
                </ul>
            </div>
        <?php
        endif;
        ?> 
        <?php
        else:
        ?> 
            <p>No se encontraron resultados para la búsqueda de "<?= $buscar; ?>"</p>
        <?php
        endif;
        ?>
    </div>
    
</section>