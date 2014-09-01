<?php
include_once('config.php');
include_once('class/class.database.php');
include_once('class/class.sitio.php');

$site = new sitio();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="img/iconologo.png">

        <title><?php echo $site->getTitle();?></title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/start/jquery-ui.css">
        <!-- Bootstrap core CSS -->
        <link href="./css/bootstrap.css" rel="stylesheet">
        <link href="./css/bootstrap-responsive.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="./css/bootstrap-theme.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/theme.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>

    <body role="document">
        <!-- Fixed navbar -->
        <div class="navbar-wrapper">
            <div class="container">
                <a href="?" ><img src="img/logo2-crop.png" height="80" alt="CajasAR" /></a>
                <button id="btnAdmin" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-login" style="margin-top:20px; margin-right:20px;"><span class="glyphicon glyphicon-user" ></span> Admin</button>
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Menu</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            
                            <?php
                            $navbar = $site->getNavbarItems();
                            foreach($navbar as $item){
                                $li = '<li class="';
                                $attr = '';
                                $subNavbar = $site->getNavbarItems($item->ID);
                                if($subNavbar){
                                    $li .= 'dropdown"';
                                    if ($item->ID == $_GET['pid'])
                                        $li .=' open';
                                    //class="dropdown-toggle" data-toggle="dropdown"
                                    $li .= '><a href="?op=pages&pid='.$item->ID.'" class="dropdown-toggle" data-toggle="dropdown">'.$item->page_title.'<b class="caret"></b></a>';
                                }
                                else
                                    $li .= '"><a href="?op=pages&pid='.$item->ID.'&'.$item->page_vars.'">'.$item->page_title.'</a>';
                                
                                echo $li;
                                
                                if($subNavbar){
                                    /* Tiene sub menu el menu */
                                    echo '<ul class="dropdown-menu">';
                                    foreach($subNavbar as $subitem)
                                        echo '<li><a href="?op=pages&pid='.$subitem->ID.'&'.$subitem->page_vars.'">'.$subitem->page_title.'</a></li>';
                                    echo '</ul>';
                                }
                                
                                echo '</li>';
                            }
                            ?>
                        </ul>
                        <div clas="navbar navbar-right">
                            <form class="navbar-form navbar-right" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Buscar">
                                </div>
                                
                            </form>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            require_once('views/slider.php');
            switch($_GET['op']){
                case 'pages':
                    require_once('views/pages.php');
                    break;
                case 'prop':
                    require_once('views/propiedad.php');
                    break;
                default:
                    require_once('views/home.php');
                    break;
            }
        ?>
        
    
    <div class="container">
        <footer>
            <p>
                <b>L.G.I.</b> - Lenguaje generadores de informes. Año 2014 - 3ero. 1era.<br>
                <b>Grupo 7</b> - Integrantes: Fioraneli, Manatini, Percoco, Valle.
            </p>
        </footer>
    </div>
    <div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="modal-interesado-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="modal-interesado-label" >Ingreso administración</h4>
                        <small>Ingreso a la secci&oacute;n del backend..</small>
                    </div>
                    <div class="modal-body">
                        <form role="form" class="">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon glyphicon glyphicon-user"></span>
                                <input type="text" class="form-control" placeholder="Usuario" name="usuario" id="input_usuario" />
                            </div>
                            <br>
                            <div class="input-group input-group-lg">
                                <span class="glyphicon glyphicon-lock input-group-addon"></span>
                                <input type="password" class="form-control" placeholder="Clave" name="clave" id="input_clave" />
                            </div>
                            <hr>
                            <div name="msgLogin" id="msgLogin" class="alert hidden"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary btnEstoyInteresado" id="btnLogin">Ingresar</button>
                    </div>
                </div>
            </div>
        </div>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/assets/docs.min.js"></script>
    <script src="js/assets/holder.js"></script>
    <script>
        !function ($) {
            $(function(){
                // carousel demo
                $('#myCarousel').carousel()
            })
        }(window.jQuery)
    </script>
    
</body>
</html>
