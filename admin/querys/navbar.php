<?php
require_once('../load.php');
$back = new Backend();
if($back->isLogged()){
    $navbar = array(
        'sitio' => array(
            'usuario' => $_SESSION['user']->user_name,
            'perfil' => $_SESSION['user']->user_profile
        ),
        'items' => array(
            array('label' => 'Inicio', 'link' => '#'),
            array('label' => 'Caja', 'link' => '#/Caja'),
            array('label' => 'Mensajes', 'link' => '#/Mensajes'),
            array('label' => 'Propiedades', 'link' => '#/Propiedades'),
            array('label' => 'Paginas', 'link' => '#/Paginas'),
            array('label' => 'Salir', 'link' => '#/logout')
        )
    );
}
else{
    $navbar = array(
        'sitio' => array('nombre' => 'CajasAR'),
        'items' => array(
            array('label' => 'Inicio', 'link' => '#')
        )
    );
}

echo json_encode($navbar);
?>