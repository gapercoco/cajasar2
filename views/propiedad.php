<?php
/* View para las paginas en general. */
include_once('config.php');
include_once('class/class.database.php');
include_once('class/class.sitio.php');

$site = new sitio();
$prop = $site->getPropiedad($_GET['propid']);
?>
<div class="container pages">
    <div class="page-header">
        <h1><?php echo $prop[0]->prop_title;?><small> - <?php echo $prop[0]->prop_resume;?></small></h1>
        
    </div>
    <div>
        <div class="row">
            <div class="col-md-8">
                <!-- Carousel de la propiedad-->
                <div id="carousel-propiedad" class="carousel slide">
                    <div class="carousel-inner">
                        <?php
                            $slider = $site->getPropiedadSlider($prop[0]->ID);
                            if($slider){
                                $active = ' active';
                                foreach($slider as $slide){
                                    echo '  <div class="item propiedad'.$active.'">
                                                <img src="'.$slide->path_pic.'" alt="">
                                            </div>';
                                    $active = '';
                                }
                            }
                            else{
                                echo '  <div class="item propiedad active">
                                            <img src="'.$prop[0]->prop_slider.'" alt="">
                                        </div>';
                            }
                        ?>
                    </div>
                    <a class="left carousel-control" href="#carousel-propiedad" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-propiedad" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
                <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Descripci&oacute;n</h3>
                    </div>
                    <div class="panel-body">
                    <?php echo $prop[0]->prop_descrip;?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Especificaciones</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                                <tr><td><b>Codigo:</b></td><td><?php echo str_pad($prop[0]->ID,6,"0",STR_PAD_LEFT);?></td></tr>
                                <tr><td><b>Operaci&oacute;n:</b></td><td><?php echo $prop[0]->format;?></td></tr>
                                <tr><td><b>Tipo:</b></td><td><?php echo $prop[0]->type_desc;?></td></tr>
                                <tr><td><b>Superficie:</b></td><td><?php echo $prop[0]->prop_sup_total;?> m2</td></tr>
                                <tr><td><b>Sup. Cubierta:</b></td><td><?php echo $prop[0]->prop_sup_cubierta;?> m2</td></tr>
                                <tr><td><b>Dormitorios:</b></td><td><?php echo $prop[0]->prop_dormitorios;?></td></tr>
                                <tr><td><b>Baños:</b></td><td><?php echo $prop[0]->prop_banios;?></td></tr>
                                <tr><td><b>Ubicación:</b></td><td><?php echo $prop[0]->prop_ubicacion;?></td></tr>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-interesado" data-toggle="tooltip" data-placement="right" title="Haga click aquí para que agendemos sus datos">Estoy interesado!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-interesado" tabindex="-1" role="dialog" aria-labelledby="modal-interesado-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modal-interesado-label" >Estoy interesado!</h4>
                <small>Si estas interesado en esta propiedad, por favor dejanos tus datos para comunicarnos.</small>
            </div>
            <div class="modal-body">
                <form role="form" class="">
                    <div class="form-group">
                        <label for="name" class="sr-only">Nombre y apellido</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nombre y apellido">
                    </div>
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" value="" class="form-control" placeholder="Email" ><br>
                    </div>
                    <div class="form-group">
                        <label for="Telefono" class="sr-only">Telefono</label>
                        <input type="text" name="telefono" id="telefono" value="" class="form-control" placeholder="Telefono">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="comentario">Comentario</label>
                        <textarea class="form-control" name="comentario" id="comentario" placeholder="Mensaje"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btnEstoyInteresado" id="btnEstoyInteresado">Enviar</button>
            </div>
        </div>
    </div>
</div>