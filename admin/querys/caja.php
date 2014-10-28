<?php
require_once('../load.php');
$back = new Backend();
if($back->isLogged()){
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $id = file_get_contents("php://input");
            //echo json_encode($back->setMessagesAsRead($id));
            break;
        case 'DELETE':
            $a = explode('/',$_SERVER['REQUEST_URI']);
            $id = array_pop($a);
            echo json_encode($back->deletePropiedad($id));
            break;
        default:
            $a = array(
                'movimientos' => $back->getMovimientos(),
                'cheques' => $back->getCheques(),
                'clientes' => $back->getClientes(),
                'bancos' => $back->getBancos()
            );
            echo json_encode($a);

    }
}
?>