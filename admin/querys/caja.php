<?php
define('DEBUG',false);
if(DEBUG == true)
{
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
}
require_once('../load.php');
$back = new Backend();
if($back->isLogged()){
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $data = json_decode(file_get_contents("php://input"));
            echo json_encode($back->addMovimiento($data));
            break;
        case 'DELETE':
            $a = explode('/',$_SERVER['REQUEST_URI']);
            $id = array_pop($a);
            echo json_encode($back->deleteMovimiento($id));
            break;
        default:
            $a = array(
                'movimientos' => $back->getMovimientos(),
                'cheques' => $back->getCheques(),
                'clientes' => $back->getClientes(),
                'bancos' => $back->getBancos(),
                'ivas' => $back->getIVAS()
            );
            echo json_encode($a);

    }
}
?>