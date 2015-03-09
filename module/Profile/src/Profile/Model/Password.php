<?php
namespace Profile\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Password implements InputFilterAwareInterface
{
	public $users_id;
	public $oldPassword;
	public $newPassword;
	protected $inputFilter;

	public function exchangeArray($data)
	{

		$this->users_id = (!empty($data['users_id'])) ? $data['users_id'] : null;
		$this->oldPassword = (!empty($data['old_password'])) ? $data['old_password'] : null;
		$this->newPassword = (!empty($data['new_password'])) ? $data['new_password'] : null;
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
					'name'     => 'user_id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));

	
			$inputFilter->add(array(
					'name'     => 'old_password',
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
											'max'      => 25,
									),
							),
					),
			));
			
			
			$inputFilter->add(array(
					'name'     => 'new_password',
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
											'max'      => 25,
									),
							),
					),
			));
			

	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
	
	
}