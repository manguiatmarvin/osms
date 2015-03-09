<?php
namespace Hr\Form;

use Zend\Form\Form;
use Zend\Db\Adapter\AdapterInterface;

class EmployeeQuizzesForm extends Form{
	protected $optionSelect;
	
	public function __construct()
	{
		
		// we want to ignore the name passed
		parent::__construct('employee_quiz');
		
		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden',
		));
		

		$this->add(array(
				'name' => 'employee_id',
				'type' => 'Hidden',
		));
		
		$this->add(array(
				'name' => 'title',
				'type' => 'Text',
				'options' => array(
						'label' => 'Title',
				),
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter title ...',
				),
		));
		
		$this->add(array(
				'name' => 'score',
				'type' => 'Text',
				'options' => array(
						'label' => 'Score',
				),
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter score ...',
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