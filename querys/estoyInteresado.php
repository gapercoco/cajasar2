<?php
    include_once('config.php');
    include_once('class/class.database.php');
    include_once('class/class.sitio.php');

    $site = new sitio();
    $nombre = $_POST['nombre'];

    $sql = 'INSERT INTO mensajes SET .....';

?>