<?php
require_once __DIR__ . '/../../clases/PedidoRepository.php';
$repoHistorial = new PedidoRepository($db);

$paginaActual = (int) ($_GET['p'] ?? 1);

$repoHistorial->paginacionHabilitar();
$repoHistorial->setPaginacionPagina($paginaActual);
$historial = $repoHistorial->getAll();
?>
<section id="admin-pedidos">
    <h1>Panel de Administración de pedidos</h1>
    <table id="historial">
        <thead class="container">
            <tr>
                <th class="col-2">Fecha</th>
                <th class="col-1">Tipo</th>
                <th class="col-2 precio">Monto productos</th>
                <th class="col-2 precio">Monto envío</th>
                <th class="col-2 precio">Monto total</th>
                <th class="col-1">Estado</th>
                <th class="col-2">Detalles</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($historial as $item): ?>
                
                <tr>
                    <td class="col-sm-12 col-md-2"><?= $item->getFecha();?></td>
                    <td class="col-sm-12 col-md-1"><?= ($item->getDelivery()) ? "Delivery" : "Take Away";?></td>
                    <td class="col-sm-12 col-md-2 precio"><span>Productos: </span> $ <?=$item->getMonto_productos();?></td>
                    <td class="col-sm-12 col-md-2 precio"><span>Envio: </span> $ <?=$item->getMonto_envio();?></td>
                    <td class="col-sm-12 col-md-2 precio"><span>Total: </span> $ <?=$item->getMonto_total();?></td>
                    <td class="col-sm-12 col-md-1 estado <?=($item->getCompletado()) ? "badge bg-success" : "badge bg-warning text-dark";?>"><?=($item->getCompletado()) ? "Completado" : "En proceso";?></td>
                    <td class="col-sm-12 col-md-2"><a href="index.php?s=detalle-pedido&id=<?= $item->getPedido_id();?>" class="btn historial-ver-detalle">Ver detalle</a></td>
                </tr>
            <?php
            endforeach;?>
        </tbody>
    </table>
    <?php
        if($repoHistorial->isPaginacionHabilitada() && $repoHistorial->getPaginacionTotalPaginas() > 1):?>
            <nav aria-label="..." class="paginacion">
                <ul class="pagination">
                <?php 
                    for($p = 1; $p <= $repoHistorial->getPaginacionTotalPaginas(); $p ++): ?>
                        <?php
                        if($p !== $paginaActual):
                        ?>
                        <li class="page-item">
                            <a href="index.php?s=pedidos&p=<?= $p; ?>" class="page-link ">
                                <?= $p; ?>
                            </a>
                        </li>
                        <?php
                        else:
                        ?>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#"><?= $p; ?></a>
                        </li>
                        <?php
                        endif;
                        ?>
                    <?php
                    endfor;
                ?>
                </ul>
            </nav>
        <?php
        endif;
        ?> 
</section>