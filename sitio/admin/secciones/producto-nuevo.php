<?php
    $categoriaRepo = new CategoriaRepository($db);
    $categorias = $categoriaRepo->all();
    
    $errores = $_SESSION['errores'] ?? [];
    $oldData = $_SESSION['oldData'] ?? [
        'categorias' => [],
    ];
    if(!isset($oldData['categorias'])){
        $oldData['categorias'] = [];
    }
    unset($_SESSION['errores'], $_SESSION['oldData']);
?>
<section id="nuevo-prod">
    <h1>Agregar nuevo producto</h1>
    <p class="mensaje-pagina">Completá el formulario</p>
    <form action="acciones/producto-crear.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" id="nombre" class="form-control" name="nombre" value="<?=$oldData['nombre'] ?? '';?>" <?=isset($errores['nombre'])? 'aria-describedby="error-nombre"':'';?>>
            <?php
            if(isset($errores['nombre'])):?>
                <div id="error-nombre"><?= $errores['nombre'];?></div>
            <?php
            endif; ?>
        </div>
        <fieldset>
            <legend id="legend">Categorias</legend>
            <?php
            foreach($categorias as $categoria): ?>
            <label class="form-check">
                <input type="checkbox" 
                class="form-check-input"
                name="categorias[]" 
                value="<?= $categoria->getCategoriaId();?>"
                <?= in_array($categoria->getCategoriaId(), $oldData['categorias']) ? 'checked' :  null;?>
                >
                <?= $categoria->getNombre();?>
            </label>
            <?php 
            endforeach;?>
        </fieldset>
        <div>
            <label for="descripcion" class="form-label">Descripcion</label>
            <textarea id="descripcion" class="form-control" name="descripcion" 
                <?=isset($errores['descripcion'])? 'aria-describedby="error-descripcion"':'';?>><?=$oldData['descripcion'] ?? '';?></textarea>
            <?php
            if(isset($errores['descripcion'])):?>
                <div id="error-descripcion"><?= $errores['descripcion'];?></div>
            <?php
            endif; ?>
        </div>
        <div>
            <label for="precio" class="form-label">Precio</label>
            <input type="text" class="form-control" id="precio" name="precio" value="<?=$oldData['precio'] ?? '';?>" <?=isset($errores['precio'])? 'aria-describedby="error-precio"':'';?>>
            <?php
            if(isset($errores['precio'])):?>
                <div id="precio"><?= $errores['precio'];?></div>
            <?php
            endif; ?>
        </div>
        <div>
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" aria-describedby="info-imagen">
            <p id="info-imagen">La imagen debe ser JPG o PNG</p>
        </div>
        <div>
            <label for="imagen_descripcion" class="form-label">Descripción de la imagen </label>
            <input type="text" class="form-control" id="imagen_descripcion" name="imagen_descripcion" value="<?=$oldData['imagen_descripcion'] ?? '';?>" <?=isset($errores['imagen_descripcion'])? 'aria-describedby="error-imagen-descripcion"':'';?>>
            <?php
            if(isset($errores['imagen_descripcion'])):?>
                <div id="imagen-descripcion"><?= $errores['imagen_descripcion'];?></div>
            <?php
            endif; ?>
        </div>
        <button type="submit"  class="btn boton">Agregar</button>
    </form>
</section>