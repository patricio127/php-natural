<?php
session_start();
//Incluyo los archivos de bootstrapping
/**
 * @var PDO $db
 */
require_once __DIR__ . '/../boostrap/conexion.php';
require_once __DIR__ . '/../boostrap/autoload.php';

//Incluyo las secciones
require __DIR__ . '/rutas/secciones.php';

//llamo la funcion para obtener las secciones
$SECCIONES = $SECCIONES_ADMIN;

//chequeo si existe la seccion
$seccionActual = $_GET['s'] ?? 'inicio';
if(!isset($SECCIONES[$seccionActual])) {
    $seccionActual = '404';
}

$autenticacion = new Autenticacion($db);

$requiereAutenticar = $SECCIONES[$seccionActual]['autenticacion'] ?? false;
if($requiereAutenticar && !$autenticacion->rolAdmin()) {
    $_SESSION['status_error'] = '<div class="erroneo"><p>Se require iniciar sesion para acceder.</p></div>';
    header("Location: index.php?s=iniciar-sesion");
    exit;
}

$statusExito = $_SESSION['status_exito'] ?? '';
$statusError = $_SESSION['status_error'] ?? '';
unset($_SESSION['status_exito'], $_SESSION['status_error']);
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../estilos/estilos.css">
        <link rel="stylesheet" href="../estilos/bootstrap/css/bootstrap.min.css" >
        
        <title><?=$SECCIONES[$seccionActual]['title'] ?? 'Natural restaurante Panel de Administración';?></title>
    </head>
    <body>
        <!--NAV-->
        <?php
        if ($seccionActual == 404):
            require __DIR__ . "/secciones/" . $seccionActual . ".php";
        else:
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-0">
            <?php
            if($autenticacion->rolAdmin()):?>
            <a class="navbar-brand" href="index.php"><h1 class="visually-hidden">Natural</h1></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="true" aria-label="Expandir el menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse flex-row-reverse " id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">INICIO</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?s=menu">MENU</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?s=pedidos">PEDIDOS</a></li>
                    <li class="nav-item"><a class="nav-link" href="acciones/logout.php">CERRAR SESION</a></li>
                </ul>
            </div>
            <?php
            else:?>
            <a class="navbar-brand" href="../index.php"><h1 class="visually-hidden">Natural</h1></a>
            <?php
            endif;?>
        </nav>
        <main class="main-content">
            <div class="container-flex">
            <?php
                if(!empty($statusExito)):?>
                    <div><?=$statusExito;?></div>
                <?php
                endif;
                if(!empty($statusError)):?>
                    <div><?=$statusError;?></div>
                <?php
                endif;
                require __DIR__ . "/secciones/" . $seccionActual . ".php";
            ?>
            </div>
            <footer>
                <div>
                    <div>
                        <h3>Sobre Nosotros</h3>
                        <p>Tenemos 11 años de experiencia en lo que hacemos, sabemos cómo hacerte feliz.</p>
                    </div>
                    <div>
                        <h4>Tienda</h4>
                        <ul>
                            <li><a href="../index.php">INICIO</a></li>
                            <li><a href="../index.php?s=menu">MENU</a></li>
                            <li><a href="../index.php?s=contacto">CONTACTO</a></li>
                        </ul>
                    </div>
                    
                    <div id="iconos">
                        <h4>Contactos</h4>
                        <ul>
                            <li>5491155025436</li>
                            <li>Guatemala 255, CABA</li>
                            <li><a href="https://www.instagram.com/" target="_blank"><img src="../iconos/instagram.svg" alt="Instagram"></a></li>
                            <li><a href="https://www.facebook.com/" target="_blank"><img src="../iconos/facebook.svg" alt="Facebook"></a></li>
                        </ul>
                    </div>
                </div>
                <p>Patricio Huang - Diseño web - noche - 3a - 2021</p>
            </footer>
        </main>
        <?php 
        endif
        ?>
        <script src="../estilos/bootstrap/js/jquery-3.5.1.min.js"></script>
        <script src="../estilos/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.carousel').carousel();
            }); 
        </script>

    </body>
</html>