<?php
require_once('../load.php');
$back = new Backend();
if($back->isLogged()){
    //echo $_SERVER['REQUEST_METHOD'];
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $id = file_get_contents("php://input");
            echo json_encode($back->setMessagesAsRead($id));
            break;
        case 'DELETE':
            
            $a = explode('/',$_SERVER['REQUEST_URI']);
            //var_dump($a);
            $id = array_pop($a);
            echo json_encode($back->deleteMessage($id));
            break;
        default:
            echo json_encode($back->getMessages());  
            
    }
    /*
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = file_get_contents("php://input");
        echo json_encode($back->setMessagesAsRead($id));
    }
    else
        echo json_encode($back->getMessages());
    */
}
?>