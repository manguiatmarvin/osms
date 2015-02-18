<?php
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
												'label' => 'Home',
												'route' => 'profile',
												'action' => 'view',
												'resource'=> 'viewProfile',
												'show_in_menu' => true,
										),

										array (
												'label' => 'My Profile',
												'route' => 'profile',
												'action' => 'my-profile',
												'resource'=> 'my-profile',
												'show_in_menu' => true,
										),
										array (
												'label' => 'Leaves',
												'route' => 'profile',
												'action' => 'my-leaves',
												'resource'=> 'my-leaves',
												'show_in_menu' => true,
										),
										
										array (
												'label' => 'Memos',
												'route' => 'profile',
												'action' => 'my-memos',
												'resource'=> 'my-memos',
												'show_in_menu' => true,
										),

										array (
												'label' => 'Attendance',
												'route' => 'profile',
												'action' => 'my-attendance',
												'resource'=> 'my-attendance',
												'show_in_menu' => true,
										),

										array (
												'label' => 'Evaluations',
												'route' => 'profile',
												'action' => 'my-evaluations',
												'resource'=> 'my-evaluations',
												'show_in_menu' => true,
										),
										array (
												'label' => 'Quizzes',
												'route' => 'profile',
												'action' => 'my-quizzes',
												'resource'=> 'my-quizzes',
												'show_in_menu' => true,
										),
										array (
												'label' => 'Feedback',
												'route' => 'profile',
												'action' => 'my-feedback',
												'resource'=> 'my-feedback',
												'show_in_menu' => true,
										),

										array (
												'label' => 'Points',
												'route' => 'profile',
												'action' => 'my-points',
												'resource'=> 'my-points',
												'show_in_menu' => true,
										),
										array (
												'label' => 'Clubs',
												'route' => 'profile',
												'action' => 'my-clubs',
												'resource'=> 'my-clubs',
												'show_in_menu' => true,
										),
										
										array (
												'label' => 'Edit Profile',
												'route' => 'profile',
												'action' => 'edit',
												'show_in_menu' => true,
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
												'resource'=>'employee',
												'pages'=> array(array('label'=>'View Employee',
														               'route'=>'hr',
														                'resource'=>'view-employe',
														                'show_in_menu' => true,
												))
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
												'show_in_menu' => true,
										
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
								'label' => 'Client',
								'route' => 'client',
								'class' => ' fa-money',
								'resource' => 'client',
								'pages' => array (
										array (
												'label' => 'client',
												'route' => 'client',
												'action' => 'index',
												'resource'=>'client-index',
												'show_in_menu' => true 
										) 
								),
								'pages' => array (
										array (
												'label' => 'My Staff',
												'route' => 'client',
												'action' => 'mystaff',
												'resource'=>'mystaff',
												'show_in_menu' => true
										),
										array (
												'label' => 'My Projects',
												'route' => 'client',
												'action' => 'client-projects',
												'resource'=>'client-projects',
												'show_in_menu' => true
										)
								),
							
								
						),
				) 
		) 
);