<?php
/* View para las paginas en general. */
include_once('config.php');
include_once('class/class.database.php');
include_once('class/class.sitio.php');

$site = new sitio();
$sliders = $site->getSlider();
?>

<div class="container">
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
            <?php
            $active = ' active';
            foreach($sliders as $slide){
                echo '
                    <div class="item'.$active.'">
                        <img src="'.$slide->prop_slider.'" alt="">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>'.$slide->prop_title.'</h1>
                                <p class="lead">'.$slide->prop_resume.'</p>
                                <a class="btn btn-large btn-primary" href="?op=prop&propid='.$slide->ID.'">ver detalles</a>
                            </div>
                        </div>
                    </div>';
                $active = '';
            }
            ?>
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</div>