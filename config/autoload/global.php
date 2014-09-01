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
								'label' => 'My Profile',
								'route' => 'profile',
								'id' => 'fa-user',
								'pages' => array (
										array (
												'label' => 'View',
												'route' => 'profile',
												'action' => 'view',
												'id'=>1
										),
										array (
												'label' => 'Edit',
												'route' => 'profile',
												'action' => 'edit',
												'show_in_menu' => false,
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
						array (
								'label' => 'Human Resource',
								'route' => 'humanresource',
								'id' => 'fa-user',
								'pages' => array (
										array (
												'label' => 'Employee',
												'route' => 'humanresource',
												'action' => 'index'
										),
										array (
												'label' => 'Pre-Employment',
												'route' => 'humanresource',
												'action' => 'index'
										),
										array (
												'label' => 'Reqruitment',
												'route' => 'humanresource',
												'action' => 'index'
										)
								)
						)
						,
// 						array (
// 								'label' => 'Accounting',
// 								'route' => 'acounting',
// 								'id' => 'fa-user',
// 								'pages' => array (
// 										array (
// 												'label' => 'Payroll',
// 												'route' => 'acounting',
// 												'action' => 'index'
// 										),
// 										array (
// 												'label' => 'Biometric',
// 												'route' => 'acounting',
// 												'action' => 'index'
// 										)
										
// 								)
// 						),
						
						array (
								'label' => 'Album',
								'route' => 'album',
								'id' => 'fa-book',
								'pages' => array (
										array (
												'label' => 'View Album',
												'route' => 'album',
												'action' => 'index' 
										),
										array (
												'label' => 'Add',
												'route' => 'album',
												'action' => 'add' 
										),
										array (
												'label' => 'Edit',
												'route' => 'album',
												'action' => 'edit',
												'show_in_menu' => false,
										),
										array (
												'label' => 'Delete',
												'route' => 'album',
												'action' => 'delete', 
												'show_in_menu' => false,
										),
										array (
												'label' => 'Search Results',
												'route' => 'album',
												'action' => 'searchresult',
												'show_in_menu' => false,
										)
										
										
								) 
						) 
				) 
		) 
);