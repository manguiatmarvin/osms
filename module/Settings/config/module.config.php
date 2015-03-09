<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Settings\Controller\Settings' => 'Settings\Controller\SettingsController',
            
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'settings' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/settings[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Settings\Controller\Settings',
                         'action'     => 'index',
                     ),
                 ),
             ),
         		
  
         ),
     ),
		'view_manager' => array (
				'template_map' => array (
						'layout/menu'  => __DIR__ . '/../view/layout/menu.phtml',
				),
				'template_path_stack' => array (
						'settings' => __DIR__ . '/../view' 
				)
				 
		),
 );
?>