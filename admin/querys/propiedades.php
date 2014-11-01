<?php
require_once('../load.php');
$back = new Backend();

if($back->isLogged()){
    $data = json_decode(file_get_contents("php://input"));
    $a = explode('/',$_SERVER['REQUEST_URI']);
    $id = array_pop($a);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            
            echo json_encode($back->guardarPropiedad($data));
            break;
        case 'DELETE':
            
            echo json_encode($back->deletePropiedad($id));
            break;
        default:
            echo json_encode($back->getPropiedades());

    }
}
?>