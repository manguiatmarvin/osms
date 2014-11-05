<?php
namespace Hr\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class EmployeeFeedback{
	public $id;
	public $feedback;
	public $create_date;
	public $from_user_id;
	public $to_employee_id;
	public $type;

	
	//input filter
	protected $inputFilter;

	public function exchangeArray($data){
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->feedback = (!empty($data['feedback'])) ? $data['feedback'] : null;
		$this->create_date = (!empty($data['create_date'])) ? $data['create_date'] : null;
		$this->from_user_id = (!empty($data['from_user_id'])) ? $data['from_user_id'] : null;
		$this->to_employee_id  = (!empty($data['to_employee_id'])) ? $data['to_employee_id'] : 0;
		$this->type = (!empty($data['type'])) ? $data['type'] : null;
	}

	
	// Add content to these methods:
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	// Add the following method:
	public function getArrayCopy(){
		return get_object_vars($this);
	}
	
	
	public function getInputFilter(){
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			
			$inputFilter->add ( array (
					'name' => 'id',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'Int' 
							) 
					) 
			) );
			
			$inputFilter->add ( array (
					'name' => 'feedback',
					'required' => false,
					'filters' => array (
							array (
									'name' => 'StripTags' 
							),
							array (
									'name' => 'StringTrim' 
							) 
					),
					'validators' => array (
							array (
									'name' => 'StringLength',
									'options' => array (
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 500 
									) 
							) 
					) 
			) );
			
			$inputFilter->add ( array (
					'name' => 'create_date',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'StripTags' 
							),
							array (
									'name' => 'StringTrim' 
							) 
					),
					'validators' => array (
							array (
									'name' => 'StringLength',
									'options' => array (
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 100 
									) 
							) 
					) 
			) );
			

			
			
			$this->inputFilter = $inputFilter;
			
		}
		
		return $this->inputFilter;
	}
}