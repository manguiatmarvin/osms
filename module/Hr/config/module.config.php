<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Hr\Controller\Hr' => 'Hr\Controller\HrController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'hr' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/hr[/][:action][/:id][/:emp_id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Hr\Controller\Hr',
                         'action'     => 'index',
                     ),
                 ),
             ),
         		
         		'paginator' => array(
         				'type' => 'segment',
         				'options' => array(
         						'route' => 'employee[page/:page]',
         						'defaults' => array(
         								'page' => 1,
         						),
         				),
         		),

         ),
     ),

     'view_manager' => array(
     		'template_map' => array (
     				'layout/hr-menu'  => __DIR__ . '/../view/layout/hr-menu.phtml',
     				'layout/hr-menu-update-e'  => __DIR__ . '/../view/layout/hr-menu-update-e.phtml',
     		),
         'template_path_stack' => array(
             'hr' => __DIR__ . '/../view',
         ),
     ),
 );
?>