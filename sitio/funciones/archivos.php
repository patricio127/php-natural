<?php
function subirImagen($imagen) {
    $nombreImagen = date('YmdHis') . "_" . $imagen['name'];

    move_uploaded_file($imagen['tmp_name'], __DIR__ . "/../img/" . $nombreImagen);
    return $nombreImagen;
}