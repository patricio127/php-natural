<?php
$oldData = $_SESSION['oldData'] ?? [];
unset($_SESSION['oldData']);
?>
<section class="iniciar-sesion">
    <h1>Ingresar al panel de administración</h1>
    <p>Debes iniciar sesion para poder acceder al panel</p>
    <form action="acciones/login.php" method="post">
        <div>
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="<?=$oldData['email'] ?? '';?>">
        </div>
        <div>
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary mx-auto px-5">Ingresar</button>
    </form>
</section>