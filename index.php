<?php

ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);

require "config.php";
require "controllers/base_controller.php";

class Dispatch {
	
	public static function Run()
	{
		$controller_name 	= isset($_GET['c']) ? $_GET['c'] : 'keys';
		$action_name 		= isset($_GET['a']) ? $_GET['a'] : 'index';
		
		require "controllers/{$controller_name}_controller.php";
		
		$class_name = ucfirst($controller_name).'Controller';
		$controller = new $class_name(array('action' => $action_name));
		$controller->run();
		
		print $controller->getView();
	}
}

Dispatch::Run();