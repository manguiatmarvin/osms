<?php
namespace Profile\Form;

use Zend\Form\Form;
use Zend\Db\Adapter\AdapterInterface;

class ChangePasswordForm extends Form{
	
	public function __construct()
	{
		
		// we want to ignore the name passed
		parent::__construct('users');

	}
	
	public function initialize(){
		
		$this->add(array(
				'name' => 'user_id',
				'type' => 'Hidden',
		));
	
		
		$this->add(array(
				'name' => 'pass_word',
				'type' => 'Text',
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter...',
				),
				'options' => array(
						'label' => 'Password',
				),
		));
		
		
		$this->add(array(
				'name' => 'new_password',
				'type' => 'Text',
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter...',
				),
				'options' => array(
						'label' => 'Re-Password',
				),
		));
		
		
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Go',
						'id' => 'profileSubmitbutton',
						'class'=>'btn btn-primary edt-profile-btn',
				),
		));
		
	}
	
	
}