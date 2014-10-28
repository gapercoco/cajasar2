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
    public function getBancos(){
        $db = DataBase::getInstance();
        $sql = 'SELECT * FROM lgi_bancos';
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
    
}
?>