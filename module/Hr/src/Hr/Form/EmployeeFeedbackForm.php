<?php
namespace Hr\Form;

use Zend\Form\Form;
use Zend\Db\Adapter\AdapterInterface;

class EmployeeFeedbackForm extends Form{

	
	public function __construct()
	{
		
		// we want to ignore the name passed
		parent::__construct('employee_feedback');
		
		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden',
		));

		
		$this->add(array(
				'name' => 'feedback',
				'type' => 'Text',
				'options' => array(
						'label' => 'Your Feedback',
				),
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter feedback ...',
				),
		));
		
		
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Add',
						'id' => 'submitbutton',
				),
		));

	}
	

	
}