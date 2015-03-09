<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Client\Controller\Client' => 'Client\Controller\ClientController',
            
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'client' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/client[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Client\Controller\Client',
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
						'client' => __DIR__ . '/../view' 
				)
				 
		),
 );
?>