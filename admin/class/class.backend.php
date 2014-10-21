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
}
?>