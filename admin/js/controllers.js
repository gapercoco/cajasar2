var cajasarApp = angular.module('cajasarApp',[
    'ngRoute',
    'ngSanitize',
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
                       when ('/Paginas',{
                           templateUrl: 'views/paginas.html',
                           controller: 'paginasController',

                       }).
                       when ('/Propiedades',{
                           templateUrl: 'views/propiedades.html',
                           controller: 'propiedadesController',

                       }).
                       when ('/Seguridad',{
                           templateUrl: 'views/seguridad.html',
                           controller: 'seguridadController',

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
cajasarAppControllers.controller('paginasController',function($scope,$http){
    console.log('Home');
});
cajasarAppControllers.controller('propiedadesController',function($scope,$http){
    
    $scope.propiedades = [];
    $scope.fotos = [];
    $scope.fotosPropiedad = [];
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
    $scope.guardarPropiedad = function(){
        console.log('Guardar');
        $('#btnGuardarPropiedad').removeClass('btn-success').disabled = true;
        $scope.propiedad.prop_descrip = $('#descripcionPropiedad').code();
        var p = {
            prop: $scope.propiedad,
            fotos:$scope.fotosPropiedad
        };
        $http.post('querys/propiedades.php',p).success(function(data){
           console.log(angular.toJson(data));
            if(data != 'false'){
                $('#btnGuardarPropiedad').addClass('btn-success').disabled = false;
                $scope.propiedad.ID = data.ID;
            }
            else{
                $('#btnGuardarPropiedad').addClass('btn-danger').disabled = false;
                alert('Ocurrio un error. Vuelva a intentarlo');
            }
        });
    }
    
    $scope.editarPropiedad = function(id){

        //$('#modalNuevaPropiedad').modal('show');
        for(var i = 0; i < $scope.propiedades.length; i++)
            if($scope.propiedades[i].ID == id){
                $scope.propiedad = $scope.propiedades[i];
                $('#descripcionPropiedad').code($scope.propiedades[i].prop_descrip);
                $scope.getFotosPropiedad(id);
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
    $scope.getFotos = function(){
        $http.get('querys/fotos.php').success(function(data){
            $scope.fotos = data;
        });
    }
    $scope.getFotosPropiedad = function(id){
        $http.get('querys/fotos.php/'+id).success(function(data){
            $scope.fotosPropiedad = data;
        });
    }
    
    
    $scope.getFotos();
});
cajasarAppControllers.controller('cajaController',function($scope,$http){
    $scope.saldoTotal = 0;
    $scope.saldoEFE = 0;
    $scope.saldoCHC = 0;
    $scope.cliente = {};
    $scope.movimiento = {};
    $scope.cheque = {};

    $scope.getData = function(){
        $http.get('querys/caja.php').success(function(data){
            $scope.caja = data; 
            for(var i=0;i<$scope.caja.movimientos.length;i++){
                if($scope.caja.movimientos[i].tipo === 'INGRESO'){
                    $scope.saldoTotal += parseFloat($scope.caja.movimientos[i].total);
                    if($scope.caja.movimientos[i].valor === 'EFE')
                        $scope.saldoEFE += parseFloat($scope.caja.movimientos[i].total);
                    else
                        $scope.saldoCHC += parseFloat($scope.caja.movimientos[i].total);
                }
                else{
                    $scope.saldoTotal -= parseFloat($scope.caja.movimientos[i].total);
                    if($scope.caja.movimientos[i].valor === 'EFE')
                        $scope.saldoEFE -= parseFloat($scope.caja.movimientos[i].total);
                    else
                        $scope.saldoCHC -= parseFloat($scope.caja.movimientos[i].total);
                }
            }
        });
    }

    $scope.guardarCliente = function(){
        $('#btnGuardarCliente').removeClass('btn-success').disabled = true;

        if(angular.isString($scope.cliente.nombre) && angular.isString($scope.cliente.cliente)){
            $http.post('querys/clientes.php',$scope.cliente).success(function(data){

                if(data != 'false'){
                    if(data === '0'){
                        for(var i=0;i<$scope.caja.clientes.length;i++){
                            if($scope.caja.clientes[i].ID === $scope.cliente.ID)
                                $scope.caja.clientes[i] = $scope.cliente;
                        }
                    }
                    else{
                        $scope.cliente.ID = data;
                        $scope.caja.clientes.push($scope.cliente);    
                    }
                    $('#btnGuardarCliente').addClass('btn-success').disabled = false;
                }
                else{

                    $('#btnGuardarCliente').addClass('btn-danger'),disabled = false;
                    console.log("Error al postear cliente: "+data);
                }
            })
        }
        else
            alert('Debe ingresar al menos la razon social e indicar si es cliente o proveedor');

    }
    $scope.editarCliente = function(id){
        for(var i=0; i<$scope.caja.clientes.length;i++){
            if($scope.caja.clientes[i].ID === id){
                $scope.cliente = $scope.caja.clientes[i];
                break;
            }
        }
        $('#modalClientes').modal('show');
    }
    $scope.deleteCliente = function(id){
        $http.delete('querys/clientes.php/'+id)
        .success(function(data){
            if(data == "true"){
                for(var i=0;i<$scope.caja.clientes.length;i++)
                    if($scope.caja.clientes[i].ID == id){
                        $scope.caja.clientes.splice(i,1);  
                        break;
                    }
            }
            else
                alert('Ocurrio un error al eliminar el cliente.');

        })
        .error(function(){
            alert('Ocurrio un error.');
        })
    }
    $scope.filtraClientes = function(){
        if($scope.movimiento.tipo === 'INGRESO')
            return 1;
        else
            return 0;
    }
    $scope.guardarMovimiento = function(){
        
        var m = {
            movimiento: $scope.movimiento,
            valor: $scope.cheque
        }
        $http.post('querys/caja.php',m).success(function(data){
            if(data === 'true'){
                $scope.getData();
                $('#modalMovimiento').modal('hide');
            }
            else{
                console.log(data);
                alert('Ocurrio un error!');
            }
        });
    }
    $scope.eliminarMovimiento = function(id){
        if(confirm('Esta seguro que desea eliminar este movimiento?')){
            $http.delete('querys/caja.php/'+id).success(function(data){
                if(data === 'true'){
                    $scope.getData();
                    
                }
                else
                    alert("Ocurrio un error al eliminar. Vuelva a intetarlo");
            })
        }
        else
            console.log("No elimino");
    }
    $scope.getNombreBanco = function(id){
        for(var i=0;i<$scope.caja.bancos.length;i++)
            if($scope.caja.bancos[i].ID === id)
                return $scope.caja.bancos[i].descripcion;
    }
    $scope.getNombreCliente = function(id){
        for(var i=0;i<$scope.caja.clientes.length;i++)
            if($scope.caja.clientes[i].ID === id)
                return $scope.caja.clientes[i].nombre;
    }
    $scope.getData();
});
cajasarAppControllers.controller('seguridadController',function($scope,$http,$interval){
    $scope.logs = [];
    
    $scope.getLogs = function(){
        $http.get('querys/logs.php').success(function(data){
            $scope.logs = data;
        });
    }
    $scope.getLogs();
});