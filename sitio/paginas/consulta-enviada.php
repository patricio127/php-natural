<?php
//Este archivo se va a encargar de recibir las informaciónes que nos manda el usuario
//Esto lo vamos a lograr con los siguientes pasos:
//1. Capturamos los datos del form
//2. Checkeo el correo, que no sea null
//3. Envio el correo al administrador
//4. Valido los datos ingresados por el usuario, si no hay datos envio un mensaje
//5. Creo el mensaje '\n: significa nueva linea'
//6. Se envía el e-mail usando la función mail() de PHP
//7. Le muestra el mensaje exitosa al usuario

const motivos = ["", "Marketing", "Administración y finanzas", "Sugerencias"];
const mail_contacto = "contacto@naturalsushi.com";

//1. Capturamos los datos del form
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$numero = $_POST['numero'];
$comentario = $_POST['comentario'];
if (is_numeric($_POST["motivo"])) {
     $motivo= motivos[$_POST["motivo"]];
} else {
     $motivo= "Consulta desde la web";
}

//2. Checkeo el correo, que no sea null
if(isset($email)) {

//3. envio el correo al administrador
$email_to = "patricio.huang@davinci.edu.ar";
$email_subject = $motivo;
$email_from = $email;

//4.valido los datos ingresados por el usuario, si no hay datos envio un mensaje
if(!isset($nombre) ||
!isset($numero) ||
!isset($comentario)) {

$mensaje = ' <div id="mensaje-error">
<img src="img/error-consulta.jpg" alt="Error">
<p>Ocurrió un error y el formulario no ha sido enviado. </p>
<p>Por favor, vuelva atrás y verifique la información ingresada</p>
</div>';

exit($mensaje);
}

//5. Creo el mensaje '\n: significa nueva linea'
$email_message = "Detalles del formulario de contacto:\n\n";
$email_message .= "Nombre: " . $nombre . "\n";
$email_message .= "E-mail: " . $email . "\n";
$email_message .= "Telefono: " . $numero . "\n";
$email_message .= "Comentarios: " . $comentario . "\n\n";


//6.se envía el e-mail usando la función mail() de PHP
$headers = 'From: '.mail_contacto."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($email_to, $email_subject, $email_message, $headers);

//7.Le muestra el mensaje exitosa al usuario
echo "<div id=\"exito\"><img src=\"img/comprobado.png\" alt=\"Éxito\" >
     <p>¡El formulario se ha enviado con éxito!</p></div>";
}