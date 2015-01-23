<?php 
namespace SanAuth\Form;

use Zend\Form\Form;

Class RegistrationForm extends Form{

	protected $inputFilter;

	public function __construct(){
		// we want to ignore the name passed
		parent::__construct('user_profile');
		
		
		$this->add(array(
				'name' => 'remember_me',
				'type' => 'Hidden',
		));
		
		$this->add(array(
				'name' => 'username',
				'type' => 'Text',
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter  username ...',
						'size'=>'45',
				),
				'options' => array(
						'label' => 'Username',
				),
		));
		
		$this->add(array(
				'name' => 'password1',
				'type' => 'Password',
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'',
						'size'=>'45',
				),
				'options' => array(
						'label' => 'Password',
				),
		));
		
		$this->add(array(
				'name' => 'accept_terms',
				'type' => 'Checkbox',
				'attributes' => array(
						'class'  => 'form-control',
						'style' => "width:14px; height:14px"
				),
				'options' => array(
						'label' => 'Accept Terms?',
				),
		));
		
		
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Login',
						'id' => 'loginSubmitbutton',
						'class'=>'btn btn-primary edt-profile-btn',
				),
		));
		
	}
}
?>