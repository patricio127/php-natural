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
                    <td class="col-2"><?= $item->getFecha();?></td>
                    <td class="col-1"><?= ($item->getDelivery()) ? "Delivery" : "Take Away";?></td>
                    <td class="col-2 precio">$ <?=$item->getMonto_productos();?></td>
                    <td class="col-2 precio">$ <?=$item->getMonto_envio();?></td>
                    <td class="col-2 precio">$ <?=$item->getMonto_total();?></td>
                    <td class="col-1 estado <?=($item->getCompletado()) ? "badge bg-success" : "badge bg-warning text-dark";?>"><?=($item->getCompletado()) ? "Completado" : "En proceso";?></td>
                    <td class="col-2"><a href="index.php?s=detalle-pedido&id=<?= $item->getPedido_id();?>" class="btn">Ver detalle</a></td>
                </tr>
            <?php
            endforeach;?>
        </tbody>
    </table>
    <?php
        if($repoHistorial->isPaginacionHabilitada() && $repoHistorial->getPaginacionTotalPaginas() > 1):?>
            <div class="paginacion">
                <p>Páginas</p>
                <ul>
                <?php 
                    for($p = 1; $p <= $repoHistorial->getPaginacionTotalPaginas(); $p ++): ?>
                        <li>
                            <?php
                            if($p !== $paginaActual):
                            ?>
                                <a href="index.php?s=pedidos&p=<?= $p; ?>">
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
</section>