<?php
//date_default_timezone_set('America/Chicago');

date_default_timezone_set('Asia/Manila'); 
define('ROOT_PATH', dirname(__DIR__));
$protocol = ($_SERVER["SERVER_PROTOCOL"]=='HTTP/1.1') ? "http://":"https://";
define('SERVER_PROTOCOL',$protocol);
define('HOST',$protocol.$_SERVER["HTTP_HOST"]);

/**
 * Display all errors when APPLICATION_ENV is development.
 */
if(!empty($_SERVER['APPLICATION_ENV'])){
	if ($_SERVER['APPLICATION_ENV'] == 'development') {
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
	}
	
}

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
