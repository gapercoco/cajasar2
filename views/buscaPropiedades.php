<?php
/* View para las paginas en general. */
include_once('config.php');
include_once('class/class.database.php');
include_once('class/class.sitio.php');

$site = new sitio();

$propiedades = $site->getPropiedadesByType($_GET['type']);
if($propiedades){
    echo '<div id="row">';
    foreach($propiedades as $propiedad){
        echo '  <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img data-src="holder.js/300x200" src="'.$propiedad->prop_slider.'" alt="...">
                        <div class="caption">
                            <h3>'.$propiedad->prop_title.'</h3>
                            <p>'.$propiedad->prop_resume.'</p>
                            <p><a href="?op=prop&propid='.$propiedad->ID.'" class="btn btn-primary" role="button">Ver detalles</a></p>
                        </div>
                    </div>
                </div>';
    }
    echo '</div>';
}
else
    echo '<div class="alert alert-info"><b>Atenci&oacute;n:</b> No hay resultados para la busqueda solicitada</div>';
    
?>
