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
		'view_helper_config' => array(
				'flashmessenger' => array(
						'message_open_format' => '< div%s >',
						'message_separator_string' => '< br >',
						'message_close_string' => '<  /div >',
				),
		),
		'navigation' => array (
				'default' => array (
						
						array (
								'label' => 'Dashbaord',
								'route' => 'home',
								'id' => 'fa-dashboard', 
								'resource'=> 'home',
						)
						,
						array (
								'label' => 'My Profile',
								'route' => 'profile',
								'class' => 'fa-user',
								'resource'=> 'myProfile',
								'pages' => array (
										array (
												'label' => 'View',
												'route' => 'profile',
												'action' => 'view',
												'show_in_menu' => true,
										),
										array (
												'label' => 'Edit',
												'route' => 'profile',
												'action' => 'edit',
												'show_in_menu' => false,
										),
										array (
												'label' => 'Change Password',
												'route' => 'profile',
												'action' => 'change-password',
												'show_in_menu' => false,
										),
										array (
												'label' => 'Settings',
												'route' => 'profile',
												'action' => 'settings',
												'show_in_menu' => true,
										),
										array (
												'label' => 'Logout',
												'route' => 'login/process',
												'action' => 'logout',
												'show_in_menu' => true,
										) 
								) 
						),
						array (
								'label' => 'Human Resource',
								'route' => 'hr',
								'class' => 'fa-user',
								'pages' => array (
										array (
												'label' => 'Employee',
												'route' => 'hr',
												'action' => 'employee' 
										),
										array (
												'label' => 'Pre-Employment',
												'route' => 'hr',
												'action' => 'index' 
										),
										array (
												'label' => 'Recruitement',
												'route' => 'hr',
												'action' => 'index'
										)
										,
										array (
												'label' => 'Employee Details',
												'route' => 'hr',
												'action' => 'view-employee',
												'show_in_menu' => false,
										)
								)
								 
						),
						
						array (
								'label' => 'Album',
								'route' => 'album',
								'class' => 'fa-book',
								'resource'=> 'album',
								'pages' => array (
										array (
												'label' => 'View Album',
												'route' => 'album',
												'action' => 'index',
												 
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