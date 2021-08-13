<?php
    /**
     * @var PDO $db
     */
    $categoriaRepo = new CategoriaRepository($db);
    $categorias = $categoriaRepo->all();
    
    $errores = $_SESSION['errores'] ?? [];
    $oldData = $_SESSION['oldData'] ?? [];


    if(count($oldData) === 0) {
        $id = (int) $_GET['id'];
        $repo = new ProductoRepository($db);
        $producto = $repo->getByPk($id, true);
        
        $categoriasProducto=[];
        foreach($producto->getCategorias() as $categoria) {
            $categoriasProducto[] = $categoria->getCategoriaId();
        };
        $oldData = [
            'nombre'                => $producto->getNombre(),
            'descripcion'           => $producto->getDescripcion(),
            'precio'                => $producto->getPrecio(),
            'imagen_actual'         => $producto->getImagen(),
            'imagen_descripcion'    => $producto->getImagenDescripcion(),
            'categorias'            => $categoriasProducto,
        ];
    };

    unset($_SESSION['errores'], $_SESSION['oldData']);
?>
<section id="editar">
    <h1>Editar producto</h1>
    <p class="mensaje-pagina">Modificá los datos del producto</p>
    <form action="acciones/producto-editar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="producto_id" value="<?= $_GET['id'];?>">
        <input type="hidden" name="imagen_actual" value="<?= $oldData['imagen_actual'];?>">
        <div class="my-2">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$oldData['nombre'] ?? '';?>" <?=isset($errores['nombre'])? 'aria-describedby="error-nombre"':'';?>>
            <?php
            if(isset($errores['nombre'])):?>
                <div id="error-nombre"><?= $errores['nombre'];?></div>
            <?php
            endif; ?>
        </div>
        <fieldset class="my-2">
            <legend class="legend">Categorias</legend>
            <?php
            foreach($categorias as $categoria): ?>
            <label class="form-check">
                <input type="checkbox" 
                name="categorias[]" 
                class="form-check-input"
                value="<?= $categoria->getCategoriaId();?>"
                <?= in_array($categoria->getCategoriaId(), $oldData['categorias']) ? 'checked' :  null;?>
                >
                <?= $categoria->getNombre();?>
            </label>
            <?php 
            endforeach;?>
        </fieldset>
        <div class="my-2">
            <label for="descripcion" class="form-label">Descripcion</label>
            <textarea id="descripcion" class="form-control" name="descripcion" <?=isset($errores['descripcion'])? 'aria-describedby="error-descripcion"':'';?>><?=$oldData['descripcion'] ?? '';?></textarea>
            <?php
            if(isset($errores['descripcion'])):?>
                <div id="descripcion"><?= $errores['descripcion'];?></div>
            <?php
            endif; ?>
        </div>
        <div class="my-2">
            <label for="precio" class="form-label">Precio</label>
            <input type="text" class="form-control" id="precio" name="precio" value="<?=$oldData['precio'] ?? '';?>" <?=isset($errores['precio'])? 'aria-describedby="error-precio"':'';?>>
            <?php
            if(isset($errores['precio'])):?>
                <div id="precio"><?= $errores['precio'];?></div>
            <?php
            endif; ?>
        </div>
        <div class="my-2">
            <p>Imagen actual</p>
            <img src="<?='./../img/' . $oldData['imagen_actual'];?>" alt="Previsualizacion de la imagen">
        </div>
        <div class="my-2">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" aria-describedby="info-imagen">
            <p id="info-imagen">La imagen debe ser JPG o PNG</p>
        </div>
        <div class="my-2">
            <label for="imagen_descripcion" class="form-label">Descripción de la imagen </label>
            <input type="text" class="form-control" id="imagen_descripcion" name="imagen_descripcion" value="<?=$oldData['imagen_descripcion'] ?? '';?>" <?=isset($errores['imagen_descripcion'])? 'aria-describedby="error-imagen-descripcion"':'';?>>
            <?php
            if(isset($errores['imagen_descripcion'])):?>
                <div id="imagen-descripcion"><?= $errores['imagen_descripcion'];?></div>
            <?php
            endif; ?>
        </div>
        <button type="submit" class="btn boton">Actualizar</button>
    </form>
</section>