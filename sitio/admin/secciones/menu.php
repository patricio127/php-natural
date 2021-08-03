<?php
/**
 * @var PDO $db;
 */
require_once __DIR__ . '/../../clases/ProductoRepository.php';
$repo = new ProductoRepository($db);
$productos = $repo->all();
?>
<section id="admin">
    <h1>Administración de Productos</h1>
    <div id="admin-agregar">
        <a href="index.php?s=producto-nuevo"><span></span> Agregar</a>
    </div>
    <table>
        <thead class="container">
            <tr>
                <th class="col-1">ID</th>
                <th class="col-1">Imagen</th>
                <th class="col-2">Nombre</th>
                <th class="col-3">Categoria</th>
                <th class="col-3">Descripción</th>
                <th class="col-1">Precio</th>
                <th class="col-1">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($productos as $producto): ?>
            <tr>
                <td class="col-1"><?=$producto->getProductoId();?></td>
                <td class="col-1 admin-imagen"><img src="<?= '../img/' . $producto->getImagen();?>" alt="<?= $producto->getImagenDescripcion();?>"></td>
                <td class="col-2"><?=$producto->getNombre();?></td>
                <td class="col-2"><?php 
                    $productoCompleto = $repo->getByPk($producto->getProductoId(), true);
                    foreach($productoCompleto->getCategorias() as $categoria): ?>
                        <?=$categoria->getNombre();?>
                    <?php
                    endforeach;
                ?></td>
                <td class="col-3"><?=$producto->getDescripcion();?></td>
                <td class="col-1">$<?=$producto->getPrecio();?></td>
                <td class="col-2 acciones">
                    <a class="btn" href="index.php?s=producto-editar&id=<?= $producto->getProductoId();?>">Editar</a>
                    <form action="acciones/producto-eliminar.php" method="post" class="form-eliminar" data-nombre="<?= $producto->getNombre();?>">
                        <input type="hidden" name="producto_id" value="<?= $producto->getProductoId();?>">
                        <button class="btn">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php
            endforeach;?>
        </tbody>
    </table>
    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
            </div>
            <div class="modal-body">
                <p>Esta seguro de eliminar <span id="modal-nombre-producto"></span>?</p>
            </div>
            <div class="modal-footer" >
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelar-eliminar">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmar-eliminar">Eliminar</button>
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
        const formsEliminar = document.querySelectorAll('.form-eliminar');
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