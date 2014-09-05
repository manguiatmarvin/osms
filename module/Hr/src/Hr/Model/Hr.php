<?php
namespace Hr\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Hr implements InputFilterAwareInterface
{

	public $users_id;
	public $date_hired;
	public $status;
    protected $inputFilter;
    
	public function exchangeArray($data)
	{

		$this->users_id = (!empty($data['users_id'])) ? $data['users_id'] : null;
		$this->date_hired  = (!empty($data['date_hired'])) ? $data['date_hired'] : null;
		$this->status = (!empty($data['status'])) ? $data['status'] : null;
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
	
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
	
			$inputFilter->add(array(
					'name'     => 'users_id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));
	
			$inputFilter->add(array(
					'name'     => 'date_hired',
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
											'max'      => 15,
									),
							),
					),
			));

	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
	
	
}