<?php
require_once('../load.php');
$back = new Backend();
if($back->isLogged()){
    echo json_encode($back->getLogs());
}
?>