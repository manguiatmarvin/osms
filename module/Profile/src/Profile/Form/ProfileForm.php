<?php
namespace Profile\Form;

use Zend\Form\Form;
use Zend\Db\Adapter\AdapterInterface;

class ProfileForm extends Form{
	protected $genderOptionSelect;
	
	public function __construct()
	{
		
		// we want to ignore the name passed
		parent::__construct('user_profile');

	}
	
	public function initialize(){
		
		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden',
		));
		
		$this->add(array(
				'name' => 'users_id',
				'type' => 'Hidden',
		));
		
		$this->add(array(
				'name' => 'firstname',
				'type' => 'Text',
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter First Name...',
				),
				'options' => array(
						'label' => 'Firstname',
				),
		));
		
		$this->add(array(
				'name' => 'lastname',
				'type' => 'Text',
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter Last Name...',
				),
				'options' => array(
						'label' => 'Lastname',
				),
		));
		
		$this->add(array(
				'name' => 'middle',
				'type' => 'Text',
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter Middle Name...',
				),
				'options' => array(
						'label' => 'Middle',
				),
		));
		
		
		$this->add(array(
				'name' => 'birthdate',
				'type' => 'Zend\Form\Element\Date',
				'attributes' => array(
						'class'  => 'datepicker',
						'placeholder'=>'mm/dd/yyyy',
				),
				'options' => array(
						'label' => 'Birthdate',
				),
		));
		
		
		$this->add(array(
				'name' => 'gender_id',
				'type' => 'Zend\Form\Element\Select',
				'attributes' => array(
						'class'  => 'form-control',
				),
				'options' => array(
						'label'         => 'Gender',
						'value_options' => $this->getGenderOptionSelect(),
						'empty_option'  => '--- please choose ---'
				)
		));
		
		$this->add(array(
				'name' => 'address',
				'type' => 'Zend\Form\Element\Textarea',
				'attributes' => array(
						'class'  => 'form-control',
						'cols'=>'110',
						'rows'=>'5',
						'placeholder'=>'Enter Address...',
				),
				'options' => array(
						'label' => 'Address',
				),
		));
		
		
		$this->add(array(
				'name' => 'landline',
				'type' => 'Zend\Form\Element\Text',
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter Phone ...',
				),
				'options' => array(
						'label' => 'Landline',
				),
		));
		
		
		$this->add(array(
				'name' => 'cellphone',
				'type' => 'Text',
				'attributes' => array(
						'class'  => 'form-control',
						'placeholder'=>'Enter Cellphone  ...',
				),
				'options' => array(
						'label' => 'Mobile',
				),
		));
		
		$this->add(array(
				'name' => 'about',
				'type' => 'Zend\Form\Element\Textarea',
					'attributes' => array(
						'class'  => 'form-control',
						'cols'=>'110',
						'rows'=>'5',
						'placeholder'=>'Enter About...',
				),
				'options' => array(
						'label' => 'About',
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
	
	
	
	//setter and getter for options
	
	public function setGenderOptionSelect($options){
		$this->genderOptionSelect = $options;
	}
	
	public function getGenderOptionSelect(){
		return $this->genderOptionSelect;
	}
	
}