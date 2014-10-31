<?php
class Backend {

    public $logged = false;

    public function __construct() {

    }
    public function randomString($length = 50)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';   

        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters))];
        }
        return $string;
    }

    public function hashData($data)
    {
        return hash_hmac('sha512', $data, '{fw^HRYtAbeNbgN]cw\J');
    }

    public function isLogged(){
        session_start();

        if(isset($_SESSION['user']))
            $this->logged = true;
        else
            $this->logged = false;
        return $this->logged;
    }

    public function getUserByCredentials($user,$pwd){

        //$user = mysql_real_escape_string($user);
        $pwd = $this->hashData($pwd);
        $db = DataBase::getInstance();
        $sql = 'SELECT u.user_login, u.user_email, u.user_profile,u.user_name FROM lgi_users AS u WHERE u.user_login = "'.$user.'" AND u.user_passwd = "'.$pwd.'" LIMIT 1';
        $db->setQuery($sql);
        $u = $db->loadObject();
        //echo $db->showQuery();
        if($u){
            session_start();
            $_SESSION['user'] = $u;

            return $this->logged = true;
        }
        else
            return $this->logged = false;

    }
    public function getMessages(){
        $db = DataBase::getInstance();
        $sql = 'SELECT * FROM lgi_messages';
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    
    public function getPropiedades(){
        $db = DataBase::getInstance();
        $sql = 'SELECT * FROM lgi_propiedades,lgi_format,lgi_tiposprop WHERE lgi_format.IDFormat = lgi_propiedades.prop_format AND lgi_tiposprop.IDType = lgi_propiedades.prop_type';
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    public function deletePropiedad($id){
        $db = DataBase::getInstance();
        $sql = 'DELETE lgi_propiedades,lgi_fotosxprop FROM lgi_propiedades LEFT JOIN lgi_fotosxprop ON lgi_fotosxprop.ID = lgi_propiedades.ID WHERE lgi_propiedades.ID = '.$id;
        $db->setQuery($sql);
        return $db->execute();
    }
    public function setMessagesAsRead($id){
        $db = DataBase::getInstance();
        $sql = 'UPDATE lgi_messages SET lgi_messages.date_call = NOW() WHERE lgi_messages.ID = '.$id;
        $db->setQuery($sql);
        if($db->execute()){
            $sql = 'SELECT date_call FROM lgi_messages WHERE lgi_messages.ID = '.$id;
            $db->setQuery($sql);
            return $db->loadObjectList();
        }
        else
            return false;
            
        
    }
    public function deleteMessage($id){
        $db = DataBase::getInstance();
        $sql = 'DELETE FROM lgi_messages WHERE lgi_messages.ID = '.$id;
        $db->setQuery($sql);
        return $db->execute();
    }
    
    public function getMovimientos(){
        $db = DataBase::getInstance();
        $sql = 'SELECT * FROM lgi_movimientos';
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    public function addMovimiento($d){
        $db = DataBase::getInstance();
        if($d->movimiento->valor === 'CHC'){
            if( $d->valor->cartera == ''){
                $sql = 'INSERT INTO lgi_cheques SET numero = '.$d->valor->numero.', banco ='.$d->valor->banco.',fecha_emision ="'.$d->valor->fecha_emision.'",fecha_pago="'.$d->valor->fecha_pago.'",importe='.$d->valor->importe.',tipo="'.$d->valor->tipo.'"';
                $db->setQuery($sql);
                if($db->execute())
                    $nrochc = $db->lastId();
                else
                    return false;
            }
            else
                $nrochc = $d->valor->cartera;
        }
        else
            $nrochc = null;
        
        $sql = 'INSERT INTO lgi_movimientos SET fecha = "'.$d->movimiento->fecha.'",tipo="'.$d->movimiento->tipo.'",comprobante="'.$d->movimiento->comprobante.'",neto='.$d->movimiento->neto.',tipo_iva='.$d->movimiento->iva.',total='.$d->movimiento->total.',cliente='.$d->movimiento->cliente.',valor="'.$d->movimiento->valor.'",nrochc='.$nrochc.',usuario="'.$_SESSION['user']->user_login.'",descripcion="'.$d->movimiento->descripcion.'"';
        $db->setQuery($sql);
        if($db->execute())
            return true;
        else
            return mysql_error();
    }
    
    public function getCheques(){
        $db = DataBase::getInstance();
        $sql = 'SELECT * FROM lgi_cheques';
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    public function getClientes(){
        $db = DataBase::getInstance();
        $sql = 'SELECT * FROM lgi_clientes';
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    
    public function createCliente($data){
        $db = DataBase::getInstance();
        if(isset($data->ID))
            $sql = 'UPDATE lgi_clientes lgi_clientes SET cliente = '.$data->cliente.', nombre = "'.$data->nombre.'", domicilio = "'.$data->domicilio.'",telefono = "'.$data->telefono.'", email = "'.$data->email.'" WHERE ID = '.$data->ID;
        else
            $sql = 'INSERT INTO lgi_clientes SET cliente = '.$data->cliente.', nombre = "'.$data->nombre.'", domicilio = "'.$data->domicilio.'",telefono = "'.$data->telefono.'", email = "'.$data->email.'"';
        $db->setQuery($sql);
        if($db->execute())
            return $db->lastId();
        else
            return false;
    }
    public function deleteCliente($id){
        $db = DataBase::getInstance();
        $sql = 'DELETE FROM lgi_clientes WHERE lgi_clientes.ID = '.$id;
        $db->setQuery($sql);
        return $db->execute();
    }
    
    public function getBancos(){
        $db = DataBase::getInstance();
        $sql = 'SELECT * FROM lgi_bancos';
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    public function getIVAS(){
        $db = DataBase::getInstance();
        $sql = 'SELECT * FROM lgi_tipo_ivas';
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    
}
?>