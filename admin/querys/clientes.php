<?php
require_once('../load.php');
$back = new Backend();
if($back->isLogged()){
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $id = file_get_contents("php://input");
            echo json_encode($back->createCliente($id));
            break;
        case 'PUT':
            // UPDATE CLIENTE
            break;
        
        case 'DELETE':
            $a = explode('/',$_SERVER['REQUEST_URI']);
            $id = array_pop($a);
            echo json_encode($back->deleteCliente($id));
            break;
        default:
            echo json_encode($back->getPropiedades());

    }
}
?>