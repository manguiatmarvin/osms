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
								'route' => 'dashboard',
								'class' => 'fa-bar-chart-o', 
								'resource'=> 'home',
						)
						,
						array (
								'label' => 'My Profile',
								'route' => 'profile',
								'class' => 'fa-user',
								'resource'=> 'profile',
								'pages' => array (
										array (
												'label' => 'Overview',
												'route' => 'profile',
												'action' => 'view',
												'resource'=> 'viewProfile',
												'show_in_menu' => true,
										),
										array (
												'label' => 'Edit Profile',
												'route' => 'profile',
												'action' => 'edit',
												'show_in_menu' => false,
										),
										array (
												'label' => 'Update Password',
												'route' => 'profile',
												'action' => 'change-password',
												'resource'=> 'change-password',
												'show_in_menu' => true,
										),
										array (
												'label' => 'Settings',
												'route' => 'profile',
												'action' => 'settings',
												'resource'=> 'settings',
												'show_in_menu' => true,
										),
										array (
												'label' => 'Upload Picture',
												'route' => 'profile',
												'action' => 'upload-profile-picture',
												'show_in_menu' => false,
										),
										array (
												'label' => 'Logout',
												'route' => 'login/process',
												'action' => 'logout',
												'resource'=> 'profileLogout',
												'show_in_menu' => true,
										) 
								) 
						),
						array (
								'label' => 'Human Resource',
								'route' => 'hr',
								'class' => 'fa-group',
								'resource'=> 'hr',
								'pages' => array (
										array (
												'label' => 'Employee',
												'route' => 'hr',
												'action' => 'employee', 
												'resource'=>'employee'
										),
										array (
												'label' => 'Pre-Employment',
												'route' => 'hr',
												'action' => 'pre-employment',
												'resource'=>'pre-employment'
										),
										array (
												'label' => 'Recruitement',
												'route' => 'hr',
												'action' => 'index'
										),
										array (
												'label' => 'Employee Details',
												'route' => 'hr',
												'action' => 'view-employee',
												'show_in_menu' => false,
										
										),
										
										array('label' => '201 Files',
												'route' => 'hr',
												'action'=>'employee-file',
										        'show_in_menu' => false),
										
										array (
												'label' => 'Employee Memo',
												'route' => 'hr',
												'action' => 'employee-memo',
												'show_in_menu' => false,
										
										),
										array (
												'label' => 'Add Employee Memo',
												'route' => 'hr',
												'action' => 'add-employee-memo',
												'show_in_menu' => false,
										
										),
										array (
												'label' => 'Attendance',
												'route' => 'hr',
												'action' => 'employee-attendance',
												'show_in_menu' => false,
										
										),
										array (
												'label' => 'Evaluation',
												'route' => 'hr',
												'action' => 'employee-evaluation',
												'show_in_menu' => false,
										
										)
										
								)
								 
						),
						
						array (
								'label' => 'Accounting',
								'route' => 'hr',
								'class' => 'fa-book',
								'resource'=> 'accounting',
								'pages' => array (
										array (
												'label' => 'View Album',
												'route' => 'album',
												'action' => 'index',
												'show_in_menu' => false,
												 
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