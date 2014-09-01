<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'HumanResource\Controller\HumanResource' => 'HumanResource\Controller\HumanResourceController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'humanresource' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/humanresource[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'HumanResource\Controller\HumanResource',
                         'action'     => 'index',
                     ),
                 ),
             ),
         		
  
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'humanresource' => __DIR__ . '/../view',
         ),
     ),
 );
?>