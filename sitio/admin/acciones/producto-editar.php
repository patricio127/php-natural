<?php
session_start();
/**
 * @var PDO $db;
 */
require_once __DIR__ . '/../../boostrap/conexion.php';
require_once __DIR__ . '/../../boostrap/autoload.php';
require_once __DIR__ . '/../../funciones/archivos.php';

$auth = new Autenticacion($db);
if(!$auth->autenticado()) {
    $_SESSION['status_error'] = '<div class="erroneo"><p>Se require iniciar sesion para realizar esta acción.</p></div>';
    header("Location: index.php?s=iniciar-sesion");
    exit;
}


$producto_id        = $_POST['producto_id'];
$nombre             = $_POST['nombre'];
$categorias         = $_POST['categorias'];
$descripcion        = $_POST['descripcion'];
$precio             = $_POST['precio'];
$imagen             = $_FILES['imagen'];
$imagen_descripcion = $_POST['imagen_descripcion'];


$errores = [];

$validador = new ValidadorProducto($_POST);

if($validador->tieneErrores()) {
    $_SESSION['errores'] = $validador->getErrores();
    $_SESSION['oldData'] = $_POST;
    header('Location: ../index.php?s=producto-editar&id=' . $producto_id);
    exit;
}

if(!empty($imagen['tmp_name'])) {
    $nombreImagen = subirImagen($imagen);
} else {
    $nombreImagen = $_POST['imagen_actual'];
}


$repo = new ProductoRepository($db);

$exito = $repo->update($producto_id,[
    'nombre' => $nombre,
    'categorias' => $categorias,
    'descripcion' => $descripcion,
    'precio' => $precio,
    'imagen' => $nombreImagen,
    'imagen_descripcion' => $imagen_descripcion,
    'usuario_id' => 1,
]);

if($exito) {
    $_SESSION['status_exito'] = '<div class="correcto"><p>El producto fue actualizado.</p></div>';
    header("location: ./../index.php?s=menu");
} else {
    $_SESSION['status_error'] = '<div class="erroneo"><p>Ocurrió un error, el producto no fue actualizado.</p></div>';
    $_SESSION['oldData'] = $_POST;
    header('location: ./../index.php?s=producto-editar&id=' . $producto_id);
}
