<?php
/**
 * Marvin Manguiat U.
 * Sourcefit Philippines
 * Navigation for Hr Manager
 * 
 */
return array (

		array (
				'label' => 'Employee',
				'route' => 'profile',
				'action'=>'index',
				'resource' => 'Profile.index',
				'class' => 'fa-user',
				'show_in_menu' => true,
				'pages' => array(
						array (
								'label' => 'Home',
								'route' => 'profile',
								'action' => 'index',
								'resource' => 'Profile.index',
								'class' => 'fa-home',
								'show_in_menu' => true
						),
						
						array (
								'label' => 'My Profile',
								'route' => 'profile',
								'action' => 'view',
								'resource' => 'Profile.view',
								'class' => 'fa-user',
								'show_in_menu' => true
						),
						array (
								'label' => 'My Attendace',
								'route' => 'profile',
								'action' => 'my-attendance',
								'resource' => 'Profile.my-attendance',
								'class' => 'fa-calendar',
								'show_in_menu' => true,
						),
						array (
								'label' => 'My Memos',
								'route' => 'profile',
								'action' => 'my-memos',
								'resource' => 'Profile.my-memos',
								'class' => 'fa-envelope-o',
								'show_in_menu' => true,
						),

						array (
								'label' => 'My Leaves',
								'route' => 'profile',
								'action' => 'my-leaves',
								'resource' => 'Profile.my-leaves',
								'class' => 'fa-medkit',
								'show_in_menu' => true,
						),
						array (
								'label' => 'My Evaluations',
								'route' => 'profile',
								'action' => 'my-evaluations',
								'resource' => 'Profile.my-evaluations',
								'class' => ' fa-stethoscope',
								'show_in_menu' => true,
						),
						array (
								'label' => 'My Quizzes',
								'route' => 'profile',
								'action' => 'my-quizzes',
								'resource' => 'Profile.my-quizzes',
								'class' => 'fa-pencil',
								'show_in_menu' => true,
						),
						array (
								'label' => 'My Feedback',
								'route' => 'profile',
								'action' => 'my-feedbacks',
								'resource' => 'Profile.my-feedbacks',
								'class' => 'fa-comments-o',
								'show_in_menu' => true,
						),
						array (
								'label' => 'My Clubs',
								'route' => 'profile',
								'action' => 'my-clubs',
								'resource' => 'Profile.my-clubs',
								'class' => 'fa-ticket',
								'show_in_menu' => true,
						),
						array (
								'label' => 'My Points',
								'route' => 'profile',
								'action' => 'my-points',
								'resource' => 'Profile.my-points',
								'class' => 'fa-trophy',
								'show_in_menu' => true,
						)
				)
				
		)
);
?>