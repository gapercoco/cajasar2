<?php
require_once('../load.php');
$back = new Backend();
$data = json_decode(file_get_contents("php://input"));
if($back->getUserByCredentials($data->username,$data->password))
    $a = array('msg' => 'Bienvenido '.$_SESSION['user']->user_name);
else
    $a = array('msg' => 'Usuario o clave incorrectos');
echo json_encode($a);

?>