<?php
/**
 * Retorna un array con la lista de todas las secciones permitidas del sitio
 * @return string[][]
 */

$secciones_admin =
[
    'inicio'=> [
        'title' => 'Página Principal',
        'autenticacion' => true,
    ],
    'menu'=> [
        'title' => 'Administración de Productos',
        'autenticacion' => true,
    ],
    'pedidos'=> [
        'title' => 'Pedidos',
        'autenticacion' => true,
    ],
    'producto-nuevo'=> [
        'title' => 'Agregar Productos',
        'autenticacion' => true,
    ],
    'producto-editar'=> [
        'title' => 'Editar Productos',
        'autenticacion' => true,
    ],
    'detalle-producto'=> [
        'title' => 'Ver detalle del producto',
        'autenticacion' => true,
    ],
    'detalle-pedido'=> [
        'title' => 'Ver detalle del pedido',
        'autenticacion' => true,
    ],
    'iniciar-sesion'=> [
        'title' => 'Ingresar',
    ],
];