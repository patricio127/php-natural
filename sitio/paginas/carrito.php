<?php
$auth = new Autenticacion($db);
$usuario_id = $auth->getUsuario()->getUsuarioId();
$repo = new CarritoRepository($db);
$items_carrito = $repo->getByUserId($usuario_id);
?>
<section>
    <h1>Carrito</h1>
    <?php
    if(count($items_carrito) > 0):
        ?>
    <table id="carrito">
        <thead class="container">
            <tr>
                <th class="col-2">Imagen</th>
                <th class="col-2">Nombre</th>
                <th class="col-4">Descripción</th>
                <th class="col-1">Precio</th>
                <th class="col-1">Cantidad</th>
                <th class="col-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($items_carrito as $item): ?>
            <tr>
                <td class="col-2 admin-imagen"><img src="<?= 'img/' . $item->getImagen();?>" alt="<?= $item->getImagenDescripcion();?>"></td>
                <td class="col-2"><?=$item->getNombre();?></td>
                <td class="col-4"><?=$item->getDescripcion();?></td>
                <td class="col-1">$<?=$item->getPrecio();?></td>
                <td class="col-1">
                    <div>
                        <?php if($item->getCantidad() > 1): ?>
                            <form action="acciones/item-carrito-cant.php" method="post" class="form-item-cant">
                                <input type="hidden" name="id" value="<?= $item->getId();?>">
                                <input type="hidden" name="cantidad" value="<?= $item->getCantidad() - 1;?>">
                                <button class="btn">-</button>
                            </form>
                        <?php else: ?>
                            <button class="btn" disabled>-</button>
                        <?php endif; ?>
                        <?=$item->getCantidad();?>
                        <?php if($item->getCantidad() < 50): ?>
                            <form action="acciones/item-carrito-cant.php" method="post" class="form-item-cant">
                                <input type="hidden" name="id" value="<?= $item->getId();?>">
                                <input type="hidden" name="cantidad" value="<?= $item->getCantidad() + 1;?>">
                                <button class="btn">+</button>
                            </form>
                        <?php else: ?>
                            <button class="btn" disabled>+</button>
                        <?php endif; ?>
                    </div>
                </td>
                <td class="col-2 acciones">
                    <form action="acciones/item-carrito-quitar.php" method="post" class="form-item-quitar" data-nombre="<?= $item->getNombre();?>">
                        <input type="hidden" name="id" value="<?= $item->getId();?>">
                        <button class="btn">Quitar</button>
                    </form>
                </td>
            </tr>
            <?php
            endforeach;?>
        </tbody>
    </table>
    <?php
    endif;
    ?>
    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
            </div>
            <div class="modal-body">
                <p>Esta seguro que desea quitar <span id="modal-nombre-producto"></span> del carrito?</p>
            </div>
            <div class="modal-footer" >
                <button type="button" class="btn btn-primary" id="confirmar-eliminar">Quitar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelar-eliminar">Cancelar</button>
            </div>
            </div>
        </div>
    </div>
</section>
<script>
   
    document.addEventListener('DOMContentLoaded', function(){
        var myModal = document.getElementById('modal');
        var myInput = document.getElementById('cancelar-eliminar');

        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus();
        });
        const formsEliminar = document.querySelectorAll('.form-item-quitar');
        formsEliminar.forEach(elem => {
            elem.addEventListener('submit', function(ev) {
                ev.preventDefault();
                const nombre = this.dataset.nombre;
                $("#modal-nombre-producto").text(nombre);
                $("#confirmar-eliminar").click(function(){
                    elem.submit();
                });
                var modal = new bootstrap.Modal(document.getElementById('modal'));
                $("#cancelar-eliminar").click(function(){
                    modal.hide();
                });
                modal.show();
            });
        });
    });
    
</script>