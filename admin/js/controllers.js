var cajasarApp = angular.module('cajasarApp',[
    'ngRoute',
    'cajasarAppControllers'
]);
cajasarApp.config(['$routeProvider',
               function($routeProvider){
                   $routeProvider.
                   
                   when ('/',{
                       templateUrl: 'views/home.html',
                       controller: 'homeController',

                   }).
                   when ('/logout',{
                       templateUrl: 'views/logout.php',
                       controller: 'logoutController',
                       
                   }).
                   when ('/Caja',{
                       templateUrl: 'views/logout.php',
                       controller: 'logoutController',

                   }).
                   when ('/Mensajes',{
                       templateUrl: 'views/mensajes.html',
                       controller: 'mensajesController',

                   }).
                   when ('/Propiedades',{
                       templateUrl: 'views/propiedades.html',
                       controller: 'propiedadesController',

                   }).
                   otherwise({
                       redirectTo: '/'
                   });
               }
              ]);


var cajasarAppControllers = angular.module('cajasarAppControllers',[]);

cajasarAppControllers.controller('loginController',function($scope,$http,$window){
    
    $scope.credentials = {
        username: '',
        password: ''
    }
    $scope.login = function(credentials){
        $http.post('querys/login.php',credentials).success(function(data){
            $window.location.reload();
        })
    }
});
cajasarAppControllers.controller('navbarController',function($scope,$http){
    $http.get('querys/navbar.php').success(function(data){
        $scope.navbar = data;
    })
});
cajasarAppControllers.controller('mensajesController',function($scope,$http){
    $http.get('querys/mensajes.php').success(function(data){
        $scope.mensajes = data;
    })
});
cajasarAppControllers.controller('logoutController',function($scope,$window){
    $window.location.href = '#';
    $window.location.reload();
});

cajasarAppControllers.controller('homeController',function($scope,$http){
    console.log('Home');
});

cajasarAppControllers.controller('propiedadesController',function($scope,$http){
    $http.get('querys/propiedades.php').success(function(data){
        $scope.propiedades = data;
    })
    /*
    $scope.propiedad = {
        ID: '',
        prop_title:'',
        prop_resume:'',
        prop_descrip:'',
        prop_type:'',
        prop_format:'',
        prop_slider:'',
        prop_status:'',
        prop_sup_cubierta:'',
        prop_sup_total:'',
        prop_dormitorios:'',
        prop_banios:'',
        prop_ubicacion:''
        
    }
    */
    $scope.editarPropiedad = function(id){
        
        //$('#modalNuevaPropiedad').modal('show');
        for(var i = 0; i < $scope.propiedades.length; i++)
            if($scope.propiedades[i].ID == id){
                $scope.propiedad = $scope.propiedades[i];
                console.log(angular.toJson($scope.propiedad));
                break;
            }
    }
});