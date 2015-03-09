<?php
$employee_menu = include __DIR__."/navs/employee.nav.php";
$hr_manager_menu = include __DIR__."/navs/hr-manager.nav.php";
$client_menu  = include __DIR__."/navs/client.nav.php";


return array (
		'db' => array (
				'driver' => 'Pdo',
				'dsn' => 'mysql:dbname=osms;host=localhost',
				'driver_options' => array (
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'' 
				) 
		),
		'service_manager' => array (
				'factories' => array (
						'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory' 
				) 
		),
		'view_helper_config' => array(
				'flashmessenger' => array(
						'message_open_format' => '< div%s >',
						'message_separator_string' => '< br >',
						'message_close_string' => '<  /div >',
				),
		),
		'navigation' => array (
				'default' => array (),
				'employee-menu' =>$employee_menu,
				'hr-manager-menu'=>$hr_manager_menu,
				'client_menu'=>$client_menu
		) 
);