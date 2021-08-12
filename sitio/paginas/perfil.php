<?php
$auth = new Autenticacion($db);
$repoHistorial = new PedidoRepository($db);

$tabActual = ($_GET['t'] ?? "datos");
$paginaActual = (int) ($_GET['p'] ?? 1);

$repoHistorial->paginacionHabilitar();
$repoHistorial->setPaginacionPagina($paginaActual);
$historial = $repoHistorial->getByUserId($auth->getUsuario()->getUsuarioId());

?>
<section>
    <h1>Perfil de <?= $auth->getUsuario()->getEmail();?></h1>
    <p class="mensaje-pagina">Administra tu perfil</p>

    <div class="d-flex align-items-start" id="perfil">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link <?= $tabActual == 'datos' ? 'active' : '';?>" id="datos-tab" 
            data-bs-toggle="pill" data-bs-target="#v-pills-datos" 
            type="button" role="tab" aria-controls="v-pills-datos" aria-selected="<?= $tabActual == 'datos' ? 'true' : 'false';?>">
                Mis Datos
            </button>
            <button class="nav-link <?= $tabActual == 'historial' ? 'active' : '';?>" id="historial-tab" 
            data-bs-toggle="pill" data-bs-target="#v-pills-historial" 
            type="button" role="tab" aria-controls="v-pills-historial" aria-selected="<?= $tabActual == 'historial' ? 'true' : 'false';?>">
                Mis pedidos
            </button>
        </div>
        <div class="tab-content" id="datos-perfil">
            <div class="tab-pane fade <?= $tabActual == 'datos' ? 'show active' : '';?>" id="v-pills-datos" 
            role="tabpanel" aria-labelledby="datos-tab">
                <form action="acciones/perfil-actualizar.php" method="post">
                    <p>Datos Personales</p>
                    <div class="row my-3">
                        <div class="col-md-12 col-lg-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $auth->getUsuario()->getNombre();?>" required>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?= $auth->getUsuario()->getApellido();?>" required> 
                        </div>
                    </div>
                    <div  class="row my-3">
                    <div class="col-md-12 col-lg-6">
                        <label for="telefono" class="form-label">Numero de telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $auth->getUsuario()->getTelefono();?>" required>
                    </div>
                    </div>
                    <p>Direccion de entrega</p>
                    <div class="row my-3">
                        <div class="col-md-12 col-lg-6">
                            <label for="calle" class="form-label">Calle</label>
                            <input type="text" class="form-control direccion" id="calle" name="calle" value="<?= $auth->getUsuario()->getCalle();?>">
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <label for="numero" class="form-label">Numero</label>
                            <input type="text" class="form-control direccion" id="numero" name="numero" value="<?= $auth->getUsuario()->getNumero();?>"> 
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-12 col-lg-6">
                            <label for="codigo_postal" class="form-label">Codigo Postal</label>
                            <input type="text" class="form-control direccion" id="codigo_postal" name="codigo_postal" value="<?= $auth->getUsuario()->getCodigo_postal();?>">
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <label for="dpto" class="form-label">Piso / Departamento(Opcional)</label>
                            <input type="text" class="form-control direccion" id="dpto" name="dpto" value="<?= $auth->getUsuario()->getDpto();?>">
                        </div>
                    </div>
                    <button type="submit" class="btn">Actualizar</button>
                </form>
            </div>
            <div class="tab-pane fade <?= $tabActual == 'historial' ? 'show active' : '';?>" id="v-pills-historial" 
            role="tabpanel" aria-labelledby="historial-tab">
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
                                        <a href="index.php?s=perfil&t=historial&p=<?= $p; ?>">
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
            </div>
        </div>
    </div>
</section>