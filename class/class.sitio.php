<?php
	
	class sitio {
		
        private $nombre;
        private $url;
        private $title;
        private $rootdir;
        private $description;
        private $keywords;
        private $home;
        private $estado;
        public	$logged;
        private $siteKey;
        public $mes = array(1=>"Enero",2=>"Febrero",3=>"Marzo",4=>"Abril",5=>"Mayo",6=>"Junio",7=>"Julio",8=>"Agosto",9=>"Septiembre",10=>"Octubre",11=>"Noviembre",12=>"Diciembre");

        public function __construct() {
            session_start();
            $db = DataBase::getInstance();
            $db->setQuery('SELECT * FROM `lgi_options`');
            $parametros = $db->loadObjectList();
            foreach ($parametros as $parametro) 
                $this->{$parametro->option_name} = $parametro->option_value;
        }

        /* Getters */

        public function getNombre() {
            return $this->nombre;
        }

        public function getUrl() {
            return $this->url;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getRootdir() {
            return $this->rootdir;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getKeywords() {
            return $this->keywords;
        }

        public function getStatus() {
            return $this->status;
        }

        public function getFooter() {
            return $this->footer;
        }

        public function getDisabled() {
            return $this->disabled;
        }
		
		
		public function getNavbarItems($mid=0){
            $db = DataBase::getInstance();
            $db->setQuery('SELECT ID, page_title, page_vars FROM lgi_pages AS a WHERE a.page_status = 1 AND a.page_parent = '.$mid.' ORDER BY a.page_order');
            $navbar = $db->loadObjectList();
            return $navbar;
        }		
		public function getPage($pid=1){
            $db = DataBase::getInstance();
            $db->setQuery('SELECT * FROM lgi_pages AS a WHERE a.page_status = 1 AND a.ID = '.$pid.' LIMIT 0,1');
            $page = $db->loadObjectList();
            return $page;
        }
		public function getPropiedad($propid){
            $db = DataBase::getInstance();
            $db->setQuery('SELECT * FROM lgi_propiedades AS a, lgi_tiposprop AS b, lgi_format AS c WHERE a.ID = '.$propid.' AND a.prop_status = 1 AND b.IDType = a.prop_type AND c.IDFormat = a.prop_format');
            $prop = $db->loadObjectList();
            return $prop;
        }
        public function getPropiedadSlider($pid){
            $db = DataBase::getInstance();
            $db->setQuery('SELECT * FROM lgi_fotosxprop AS a WHERE a.ID = '.$pid);
            $slide = $db->loadObjectList();
            return $slide;
        }
        public function getPropiedadesByType($type){
            $db = DataBase::getInstance();
            $db->setQuery('SELECT * FROM lgi_propiedades AS a WHERE a.prop_status = 1 AND a.prop_type = '.$type);
            $propiedades = $db->loadObjectList();
            return $propiedades;
        }
        
        public function getSlider(){
            $db = DataBase::getInstance();
            //$db->setQuery('SELECT ID, prop_title, prop_resume, prop_slider FROM lgi_propiedades AS a WHERE a.prop_slider != "" AND a.prop_status = 1');
            $db->setQuery('SELECT lgi_propiedades.ID, prop_title, prop_resume, path_pic FROM lgi_propiedades INNER JOIN lgi_fotosxprop ON lgi_fotosxprop.ID = lgi_propiedades.ID WHERE lgi_propiedades.prop_status =1 GROUP BY lgi_propiedades.ID');
            $slider = $db->loadObjectList();
            return $slider;
        }
        
        public function setMessages($nombre,$email,$telefono,$mensaje,$propiedad=0){
            $sql = 'INSERT INTO lgi_messages SET name = "'.$nombre.'",email = "'.$email.'", phone = "'.$telefono.'", message = "'.$mensaje.'", date = NOW()';
            $db = DataBase::getInstance();
            $db->setQuery($sql);
            $db->execute();
            $a = array('msg'=>'Salio OK', 'Error'=>mysql_real_escape_string(mysql_error()));
            return $a;
        }
		function cambiarfecha_mysql($fecha)
		{
		  list($dia,$mes,$ano)=explode("/",$fecha);
		  $fecha="$ano-$mes-$dia";
		  return $fecha;
		}
		function cambiarfecha_php($fecha){
		  list($ano,$mes,$dia)=explode("-",$fecha);
		  $fecha="$dia/$mes/$ano";
		  return $fecha;
		}
		/* Setters */
	}
	
?>
