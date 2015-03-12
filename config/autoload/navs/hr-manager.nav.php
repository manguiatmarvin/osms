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
				
		),

		array (
				'label' => 'Hr Manager',
				'route' => 'hr',
				'action'=>'index',
				'resource' => 'Hr.index',
				'class' => 'fa-users',
				'show_in_menu' => true,
				'pages' => array(
				      
						array (
								'label' => 'Home',
								'route' => 'hr',
								'action' => 'index',
								'resource' => 'Hr.index',
								'class' => 'fa-home',
								'show_in_menu' => true,
						),	array (
								'label' => 'Add Customer',
								'route' => 'hr',
								'action' => 'add-customer',
								'resource' => 'Hr.add-customer',
								'class' => 'fa-plus-square',
								'show_in_menu' => true,
						),
						array (
								'label' => 'Add Employee',
								'route' => 'hr',
								'action' => 'add-employee',
								'resource' => 'Hr.add-employee',
								'class' => 'fa-plus-square',
								'show_in_menu' => true,
						),
						array (
								'label' => 'Create Memo',
								'route' => 'hr',
								'action' => 'create-memo',
								'resource' => 'Hr.add-customer',
								'class' => 'fa-warning',
								'show_in_menu' => true,
						),
						 array('label' => 'Attendace Monitor',
								'route' => 'hr',
								'action' => 'attendance-monitor',
								'resource' => 'Hr.attendance-monitor',
								'class' => 'fa-calendar',
								'show_in_menu' => true
						 		
						 ),array('label' => 'Scheduling',
								'route' => 'hr',
								'action' => 'scheduling',
								'resource' => 'Hr.scheduling',
								'class' => 'fa-clock-o',
								'show_in_menu' => true,
						 		
						 ),array('label' => 'Assign Schedule To Employee',
								'route' => 'hr',
								'action' => 'assign-schedule-employee',
								'resource' => 'Hr.assign-schedule-employee',
								'class' => 'fa-clock-o',
								'show_in_menu' => false
						 		
						 ),array('label' => 'Assign Schedule To Team',
								'route' => 'hr',
								'action' => 'assign-schedule-team',
								'resource' => 'Hr.assign-schedule-team',
								'class' => 'fa-clock-o',
								'show_in_menu' => false
						 		
						 ),array('label' => 'Leave Monitor',
								'route' => 'hr',
								'action' => 'leave-monitor',
								'resource' => 'Hr.leave-monitor',
								'class' => 'fa-bar-chart-o',
								'show_in_menu' => true
									
						),array('label' => 'Evaluation',
								'route' => 'hr',
								'action' => 'evaluation',
								'resource' => 'Hr.evaluation',
								'class' => 'fa-stethoscope',
								'show_in_menu' => true
									
						),array('label' => 'Create Quiz',
								'route' => 'hr',
								'action' => 'create-quiz',
								'resource' => 'Hr.create-quiz',
								'class' => 'fa-puzzle-piece',
								'show_in_menu' => true
									
						),array('label' => 'Create News',
								'route' => 'hr',
								'action' => 'create-news',
								'resource' => 'Hr.create-news',
								'class' => 'fa-bullhorn',
								'show_in_menu' => true
									
						),array('label' => 'Clubs',
								'route' => 'hr',
								'action' => 'clubs',
								'resource' => 'Hr.clubs',
								'class' => 'fa-bookmark-o',
								'show_in_menu' => true
									
						),array('label' => 'Points',
								'route' => 'hr',
								'action' => 'points',
								'resource' => 'Hr.points',
								'class' => 'fa-star-half-full',
								'show_in_menu' => true
									
						)
				   )
		
		)
);
?>