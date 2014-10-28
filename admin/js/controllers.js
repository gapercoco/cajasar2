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
                       templateUrl: 'views/caja.html',
                       controller: 'cajaController',

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
    $scope.setMessagesAsRead = function(id){
        $http.post('querys/mensajes.php',id)
        .success(function(data){
            for(var i=0;i<$scope.mensajes.length;i++)
                if($scope.mensajes[i].ID == id)
                    $scope.mensajes[i].date_call = data[0].date_call;
            
        })
        .error(function(){
            alert('Ocurrio un error, vuelva a intentarlo');
        })
    }
    $scope.deleteMessage = function(id){
        $http.delete('querys/mensajes.php/'+id)
        .success(function(data){
            if(data == "true"){
                for(var i=0;i<$scope.mensajes.length;i++)
                    if($scope.mensajes[i].ID == id){
                        $scope.mensajes.splice(i,1);  
                        break;
                    }
            }
            else
                alert('Ocurrio un error al eliminar el mensaje.');
                
        })
        .error(function(){
            alert('Ocurrio un error.');
        })
    }
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
    $scope.deletePropiedad = function(id){
        $http.delete('querys/propiedades.php/'+id)
        .success(function(data){
            if(data == "true"){
                for(var i=0;i<$scope.propiedades.length;i++)
                    if($scope.propiedades[i].ID == id){
                        $scope.propiedades.splice(i,1);  
                        console.log('Cerrar el modal');
                        break;
                    }
            }
            else
                alert('Ocurrio un error al eliminar la propiedad.');

        })
        .error(function(){
            alert('Ocurrio un error.');
        })
    }
});
cajasarAppControllers.controller('cajaController',function($scope,$http){
    console.log('Caja');
    $scope.saldo = 0;
    $http.get('querys/caja.php').success(function(data){
        $scope.caja = data; 
        for(var i=0;i<$scope.caja.movimientos.length;i++){
            if($scope.caja.movimientos[i].tipo === 'ING')
                $scope.saldo += $scope.caja.movimientos[i].total;
            else
                $scope.saldo -= $scope.caja.movimientos[i].total;
        }
    });
    $scope.clientes = [
        {codigo:1,nombre:"Nicolas"},
        {codigo:3,nombre:"Guillermo"},
        {codigo:2,nombre:"Guido"}
    ];
    
    $scope.agregarCliente = function(){
        var cliente ={codigo:10,nombre:"Pepe"};
        $scope.clientes.push(cliente);
    }
});