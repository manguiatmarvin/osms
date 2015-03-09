<?php
namespace Hr\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class EmployeeLogins implements InputFilterAwareInterface
{
	public $id;
	public $employee_id;
	public $log_type;
	public $time;
	public $ip_address;

	//input filter
	private $inputFilter;

	public function exchangeArray($data)
	{
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->employee_id = (!empty($data['employee_id'])) ? $data['employee_id'] : null;
		$this->log_type = (!empty($data['log_type'])) ? $data['log_type'] : null;
		$this->time  = (!empty($data['time'])) ? $data['time'] : null;
		$this->ip_address = (!empty($data['ip_address'])) ? $data['ip_address'] : null;
		
	}
	
	
	// Add the following method:
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getInputFilter(){
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
	
			$inputFilter->add(array(
					'name'     => 'id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));
			
			
			$inputFilter->add(array(
					'name'     => 'employee_id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));
			
			
	          //text filename
			$inputFilter->add(array(
					'name'     => 'log_type',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			));
			
			//text filename
			$inputFilter->add(array(
					'name'     => 'time',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			));
			
	          //text description
			$inputFilter->add(array(
					'name'     => 'ip_address',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			));
			

	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
	
	
}