<?php
$auth = new Autenticacion($db);
?>
<section>
    <h1>Perfil de <?= $auth->getUsuario()->getEmail();?></h1>
    <p>Administración de tu perfil</p>
</section>