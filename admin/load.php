<?php
define("PATH_ROOT", realpath(dirname(__FILE__)));
define('PATH_CLASS',PATH_ROOT.'/class');
define('PATH_QUERYS', PATH_ROOT.'/querys');

require_once(PATH_ROOT.'/../config.php');
require_once(PATH_CLASS.'/class.database.php');
require_once(PATH_CLASS.'/class.backend.php');

?>