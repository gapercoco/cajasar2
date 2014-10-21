<?php
	
	/*
		$db = DataBase::getInstance();  
		
		// Supongamos que tenemos una tabla de usuarios  
		// Hacemos la consulta:  
		$db->setQuery('SELECT `id`,`nombre`,`grupo` FROM `usuarios`');  
		
		// La ejecutamos y al mismo tiempo obtenemos un arreglo de objetos  
		// con los campos especificados en la consulta como propiedades.  
		$usuarios = $db->loadObjectList();  
		
		// Los imprimimos directamente en pantalla...  
		foreach($usuarios as $usuario){  
		echo 'ID: '.$usuario->id;  
		echo 'Nombre: '.$usuario->nombre;  
		echo 'Grupo: '.$usuario->grupo;  
		echo '<br />';  
		}  
	*/
	class DataBase {
		
		private $conexion;
		private $resource;
		private $sql;
		public static $queries;
		private static $_singleton;
		
		public static function getInstance(){
			if (is_null (self::$_singleton)) {
				self::$_singleton = new DataBase();
			}
			return self::$_singleton;
		}
		
		private function __construct(){
			$this->conexion = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
			mysql_select_db(DB_NAME, $this->conexion);
			$this->queries = 0;
			$this->resource = null;
		}
		
		public function execute(){
			if(!($this->resource = mysql_query($this->sql, $this->conexion))){
				return null;
			}
			$this->queries++;
			return $this->resource;
		}
		
		public function alter(){
			if(!($this->resource = mysql_query($this->sql, $this->conexion))){
				return false;
			}
			return true;
		}
		
		public function loadObjectList(){
			if (!($cur = $this->execute())){
				return null;
			}
			$array = array();
			while ($row = @mysql_fetch_object($cur)){
				$array[] = $row;
			}
			return $array;
		}
		
		public function loadArrayList(){
			if (!($cur = $this->execute())){
				return null;
			}
			$array = array();
			while ($row = @mysql_fetch_array($cur)){
				$array[] = $row;
			}
			return $array;
		}
		public function setQuery($sql){
			if(empty($sql)){
				return false;
			}
			$this->sql = $sql;
			return true;
		}
		
		public function freeResults(){
			@mysql_free_result($this->resource);
			return true;
		}
		
		public function loadObject(){
			if ($cur = $this->execute()){
				if ($object = mysql_fetch_object($cur)){
					@mysql_free_result($cur);
					return $object;
				}
				else {
					return null;
				}
			}
			else {
				return false;
			}
		}
		public function showQuery(){
			return $this->sql;
		}
		
		function __destruct(){
			@mysql_free_result($this->resource);
			@mysql_close($this->conexion);
		}
	}
?>
