<?php
$oldData = $_SESSION['oldData'] ?? [];
unset($_SESSION['oldData']);
?>
<section class="iniciar-sesion">
    <h1>Iniciar Sesión</h1>
    <p class="mensaje-pagina">Debes iniciar sesion para poder acceder al panel</p>
    <form action="acciones/login.php" method="post">
        <div>
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="<?=$oldData['email'] ?? '';?>">
        </div>
        <div>
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <p>No tienes cuenta? <a href="index.php?s=registrarse">Registrarse</a></p>
        <button type="submit" class="btn btn-primary mx-auto px-5 ">Ingresar</button>
    </form>
</section>