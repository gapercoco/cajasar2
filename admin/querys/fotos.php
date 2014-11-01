<?php
require_once('../load.php');
$back = new Backend();
if($back->isLogged()){
    
    $a = explode('/',$_SERVER['REQUEST_URI']);
    $id = array_pop($a);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $id = file_get_contents("php://input");
            //echo json_encode($back->setMessagesAsRead($id));
        break;
        case 'DELETE':
        
            echo json_encode($back->deleteFoto($id));
        break;
        default:
            if(is_numeric($id))
                echo json_encode($back->getFotosPropiedad($id));
            else{
                
                $archivos = scandir('../../img/propiedades/');
                
                //var_dump($archivos);
                $a = array();
                foreach($archivos as $archivo){
                    if($archivo != '.' && $archivo != '..' && $archivo != 'Thumbs.db')
                        $a[] = array('path_pic' => $archivo);
                }
                //echo json_encode(array_splice($archivos,2));
                echo json_encode($a);
                
            }
                

    }
}
?>