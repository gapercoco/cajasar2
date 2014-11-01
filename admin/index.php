<?php 
define('DEBUG', false);
if(DEBUG == true)
{
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
}

require_once('load.php');

$back = new Backend();
?>
<html ng-app="cajasarApp">
    <head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/start/jquery-ui.css">
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-responsive.css" rel="stylesheet">
        <link href="css/cajasar.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/summernote.css">

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular-route.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-sanitize.min.js"></script>
        <script type="text/javascript" src="js/summernote.min.js"></script>
        <script type="text/javascript" src="js/summernote-es-ES.js"></script>
        <script type="text/javascript" src="js/controllers.js"></script>
        

    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" ng-controller="navbarController">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="../img/logo2-crop.png" height="25" alt="CajasAR" />
                        CajasAR
                    </a>
                    <p ng-if="navbar.sitio.usuario != null " class="navbar-text" >Sesi&oacute;n iniciada como: {{navbar.sitio.usuario}}</p>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li ng-repeat="item in navbar.items"><a href="{{item.link}}">{{item.label}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
if($back->isLogged()){
        ?>
        <div class="container-fluid" >
            <div class="row">
                <div ng-view></div>      
            </div>
        </div>
        <?php  
}
else{
    require_once('views/login.php');
    //echo $back->hashData('12345');
}
        ?>
    </body>
</html>