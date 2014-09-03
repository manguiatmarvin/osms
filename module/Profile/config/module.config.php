<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Profile\Controller\Profile' => 'Profile\Controller\ProfileController',
            
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'profile' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/profile[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Profile\Controller\Profile',
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
						'profile' => __DIR__ . '/../view' 
				)
				 
		),
 );
?>