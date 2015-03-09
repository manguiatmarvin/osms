<?php
namespace Hr\Form;

use Zend\Form\Form;
use Zend\Db\Adapter\AdapterInterface;

class EmployeeEvaluationsForm extends Form{

	
	public function __construct()
	{
		
		// we want to ignore the name passed
		parent::__construct('employee_evaluations');
		
		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden',
		));

		
		$this->add(array(
				'name' => 'title',
				'type' => 'Text',
				'options' => array(
						'label' => 'Evaluation Name',
				),
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter title ...',
				),
		));
		
		$this->add(array(
				'name' => 'notes',
				'type' => 'Zend\Form\Element\Textarea',
				'attributes' => array(
						'class'  => 'form-control',
						'cols'=>'30',
						'rows'=>'5',
						'placeholder'=>'Enter description of file...',
				),
				'options' => array(
						'label' => 'Notes',
				),
		));
		
		
		
		
		$this->add(array(
				'name' => 'evaluation_due',
				'type' => 'Text',
				'attributes' => array(
						'class'  => 'datepicker form-control'
				),
				'options' => array(
						'label' => 'Due',
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
				'name' => 'employee_id',
				'type' => 'Hidden',
		));
		
		
		$this->add(array(
				'name' => 'evaluated_by',
				'type' => 'Hidden',
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