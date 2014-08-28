<?php
return array (
		'db' => array (
				'driver' => 'Pdo',
				'dsn' => 'mysql:dbname=zend_tut1;host=localhost',
				'driver_options' => array (
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'' 
				) 
		),
		'service_manager' => array (
				'factories' => array (
						'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory' 
				) 
		),
		
		'navigation' => array (
				'default' => array (
						
						array (
								'label' => 'Dashbaord',
								'route' => 'home',
								'id' => 'fa-dashboard' 
						)
						,
						array (
								'label' => 'Profile',
								'route' => 'profile',
								'id' => 'fa-user',
								'pages' => array (
										array (
												'label' => 'View Profile',
												'route' => 'profile',
												'action' => 'index' 
										),
										array (
												'label' => 'Settings',
												'route' => 'profile',
												'action' => 'settings' 
										),
										array (
												'label' => 'Logout',
												'route' => 'login/process',
												'action' => 'logout' 
										) 
								) 
						)
						,
// 						array (
// 								'label' => 'Album',
// 								'route' => 'album',
// 								'id' => 'fa-book',
// 								'pages' => array (
// 										array (
// 												'label' => 'View Album',
// 												'route' => 'album',
// 												'action' => 'index' 
// 										),
// 										array (
// 												'label' => 'Add',
// 												'route' => 'album',
// 												'action' => 'add' 
// 										),
// 										array (
// 												'label' => 'Edit',
// 												'route' => 'album',
// 												'action' => 'edit' 
// 										),
// 										array (
// 												'label' => 'Delete',
// 												'route' => 'album',
// 												'action' => 'delete' 
// 										),
// 										array (
// 												'label' => 'Search Results',
// 												'route' => 'searchresult',
// 												'action' => 'searchresult' 
// 										)
										
										
// 								) 
// 						) 
				) 
		) 
);