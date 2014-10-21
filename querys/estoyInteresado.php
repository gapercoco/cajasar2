<?php
include_once('../config.php');
include_once('../class/class.database.php');
include_once('../class/class.sitio.php');

$site = new sitio();
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];
$propiedad = $_POST['propiedad'];

echo json_encode($site->setMessages($nombre,$email,$telefono,$mensaje,$propiedad));

?>