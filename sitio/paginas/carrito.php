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
                <th class="col-1 precio">Precio</th>
                <th class="col-1">Cantidad</th>
                <th class="col-1 precio">Subtotal</th>
                <th class="col-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($items_carrito as $item): ?>
            <tr>
                <td class="col-sm-12 col-md-2 admin-imagen"><img src="<?= 'img/' . $item->getImagen();?>" alt="<?= $item->getImagenDescripcion();?>"></td>
                <td class="col-sm-12 col-md-2"><?=$item->getNombre();?></td>
                <td class="col-sm-12 col-md-4"><?=$item->getDescripcion();?></td>
                <td class="col-sm-12 col-md-1 precio">$<?=$item->getPrecio();?></td>
                <td class="col-sm-12 col-md-1">
                    <div class="cantidad">
                        <?php if($item->getCantidad() > 1): ?>
                            <form action="acciones/item-carrito-cant.php" method="post" class="form-item-cant">
                                <input type="hidden" name="id" value="<?= $item->getId();?>">
                                <input type="hidden" name="cantidad" value="<?= $item->getCantidad() - 1;?>">
                                <button>-</button>
                            </form>
                        <?php else: ?>
                            <button disabled>-</button>
                        <?php endif; ?>
                        <?=$item->getCantidad();?>
                        <?php if($item->getCantidad() < 50): ?>
                            <form action="acciones/item-carrito-cant.php" method="post" class="form-item-cant">
                                <input type="hidden" name="id" value="<?= $item->getId();?>">
                                <input type="hidden" name="cantidad" value="<?= $item->getCantidad() + 1;?>">
                                <button>+</button>
                            </form>
                        <?php else: ?>
                            <button disabled>+</button>
                        <?php endif; ?>
                    </div>
                </td>
                <td class="col-sm-12 col-md-1 precio"><span>Subtotal: </span> $<?=($item->getPrecio())*($item->getCantidad());?></td>
                <td class="col-sm-12 col-md-1">
                    <form action="acciones/item-carrito-quitar.php" method="post" class="form-item-quitar" data-nombre="<?= $item->getNombre();?>">
                        <input type="hidden" name="id" value="<?= $item->getId();?>">
                        <button class="btn">Quitar</button>
                    </form>
                </td>
            </tr>
            <?php
            endforeach;?>
            <tr>
                <td colspan="4"></td>
                <td>Subtotal: </td>
                <?php
                    $subTotal = 0;
                    foreach($items_carrito as $item) {
                        $subtotalItem  = $item->getPrecio() * $item->getCantidad() ;
                        $subTotal = $subTotal + $subtotalItem;
                    }
                    $monto_envio = 200;
                ?>
                <td class="precio">$ <?= $subTotal ;?></td>
                <td></td>
            </tr>
            
        </tbody>
    </table>
    <div  id="check-out" class="container-fluid">
        <form action="acciones/checkout.php" method="post" class="row">
            <div class="col-md-12 col-lg-6">
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
            
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo-pedido" id="delivery" checked>
                    <label class="form-check-label" for="delivery">
                        Delivery
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo-pedido" id="take-away">
                    <label class="form-check-label" for="take-away">
                        Take Away
                    </label>
                </div>
                <div class="row my-3">
                    <div class="col-md-12 col-lg-6">
                        <label for="calle" class="form-label">Calle</label>
                        <input type="text" class="form-control direccion" id="calle" name="calle" value="<?= $auth->getUsuario()->getCalle();?>" required>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <label for="numero" class="form-label">Numero</label>
                        <input type="text" class="form-control direccion" id="numero" name="numero" value="<?= $auth->getUsuario()->getNumero();?>" required>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-12 col-lg-6">
                        <label for="codigo_postal" class="form-label">Codigo Postal</label>
                        <input type="text" class="form-control direccion" id="codigo_postal" name="codigo_postal" value="<?= $auth->getUsuario()->getCodigo_postal();?>" required>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <label for="dpto" class="form-label">Piso / Departamento(Opcional)</label>
                        <input type="text" class="form-control direccion" id="dpto" name="dpto" value="<?= $auth->getUsuario()->getDpto();?>">
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="row">
                    <div class="col-12" id="total">
                        <p>Subtotal: <?= $subTotal;?></p>
                        <p>Envío: <?= $monto_envio;?></p>
                        <p>Total: <?= $subTotal + $monto_envio;?></p>
                    </div>
                    <div class="col-12" id="realizar-pedido">
                        <input type="hidden" name="monto_productos" value="<?= $subTotal;?>">
                        <input type="hidden" name="monto_envio" value="<?= $monto_envio;?>">
                        <input type="hidden" name="monto_total" value="<?= $subTotal + $monto_envio;?>">
                        <input type="hidden" name="delivery" value="1" id="deliveyHidden">
                        <button class="btn">Realizar pedido</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
    else:
    ?>
    <p class="mensaje-pagina">No hay productos en el carrito</p>
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

        var takeawayRadio = $("#take-away");
        var deliveryRadio = $("#delivery");
        var direccion = $(".direccion");
        var deliveyHidden = $("#delivey-hidden");

        takeawayRadio.change(function() {
            if ($(this).is(':checked')) {
                direccion.attr("disabled", "disabled");
                deliveyHidden.val("0");
            }
        });
        deliveryRadio.change(function() {
            if ($(this).is(':checked')) {
                direccion.removeAttr("disabled");
                deliveyHidden.val("1");
            }
        });
    });
</script>