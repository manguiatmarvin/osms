<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Dashboard\Controller\Dashboard' => 'Dashboard\Controller\DashboardController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'dashboard' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/dasboard[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Dashboard\Controller\Dashboard',
                         'action'     => 'index',
                     ),
                 ),
             ),
         		
  
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'dashboard' => __DIR__ . '/../view',
         ),
     ),
 );
?>