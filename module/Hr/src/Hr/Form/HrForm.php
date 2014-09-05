<?php
namespace Hr\Form;

use Zend\Form\Form;
use Zend\Db\Adapter\AdapterInterface;

class HrForm extends Form{
	
	public function __construct()
	{
		
		// we want to ignore the name passed
		parent::__construct('employees');

	}
	
	public function initialize(){
		
		$this->add(array(
				'name' => 'users_id',
				'type' => 'Hidden' 
		) );
		
		$this->add ( array (
				'name' => 'date_hired',
				'type' => 'Text',
				'options' => array (
						'label' => 'Date Hired' 
				),
				'attributes' => array (
						'class'  => 'form-control',
				),
		));
		
		
		$this->add(array(
				'name'    => 'status',
				'type'    => 'Zend\Form\Element\Select',
				'options' => array(
						'label'         => 'Status',
						'value_options' => array('0'=>'denied',
				                                  '1'=>'active'),
						'empty_option'  => '--- please choose ---'
				),
				'attributes' => array(
						'class'  => 'form-control',
				),
		));
		
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Go',
						'id' => 'submitbutton',
				),
				'attributes' => array(
						'class'  => 'form-control',
				),
		));
		
	}
	

}