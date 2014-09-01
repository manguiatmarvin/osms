<?php
namespace SanAuth\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class SanAuth implements InputFilterAwareInterface
{
	public $id;
	public $users_id;
	public $firstname;
	public $lastname;
	public $middle;
	public $gender_id;
	public $address;
	public $cellphone;
	public $created;
	public $last_modified;
	public $username;
	public $profile_pic_url;
	public $about;
	private $inputFilter;
	

	public function exchangeArray($data)
	{
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->users_id = (!empty($data['users_id'])) ? $data['users_id'] : null;
		$this->firstname = (!empty($data['firstname'])) ? $data['firstname'] : null;
		$this->lastname = (!empty($data['lastname'])) ? $data['lastname'] : null;
		$this->middle = (!empty($data['middle'])) ? $data['middle'] : null;
		$this->birthdate = (!empty($data['birthdate'])) ? $data['birthdate'] : null;
		$this->gender_id = (!empty($data['gender_id'])) ? $data['gender_id'] : null;
		$this->address = (!empty($data['address'])) ? $data['address'] : null;
		$this->landline = (!empty($data['landline'])) ? $data['landline'] : null;
		$this->cellphone = (!empty($data['cellphone'])) ? $data['cellphone'] : null;
		$this->created  = (!empty($data['created'])) ? $data['created'] : null;
		$this->last_modified  = (!empty($data['last_modified'])) ? $data['last_modified'] : null;
		$this->username  = (!empty($data['username'])) ? $data['username'] : null;
		$this->profile_pic_url  = (!empty($data['profile_pic_url'])) ? $data['profile_pic_url'] : null;
		$this->about  = (!empty($data['about'])) ? $data['about'] : null;
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
					'name'     => 'id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));

	
			$inputFilter->add(array(
					'name'     => 'firstname',
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
											'max'      => 75,
									),
							),
					),
			));
			
			$inputFilter->add(array(
					'name'     => 'lastname',
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
											'max'      => 75,
									),
							),
					),
			));
			
			
			$inputFilter->add(array(
					'name'     => 'middle',
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
											'max'      => 75,
									),
							),
					),
			));
			
			
			$inputFilter->add(array(
					'name'     => 'birthdate',
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
											'max'      => 10,
									),
							),
					),
			));
			
			$inputFilter->add(array(
					'name'     => 'gender_id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));
			
			
			$inputFilter->add(array(
					'name'     => 'address',
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
											'max'      => 150,
									),
							),
					),
			));
			

			$inputFilter->add(array(
					'name'     => 'landline',
					'required' => false,
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
											'max'      => 50,
									),
							),
					),
			));
				
				
			$inputFilter->add(array(
					'name'     => 'cellphone',
					'required' => false,
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
											'max'      => 50,
									),
							),
					),
			));

	
			
			$inputFilter->add(array(
					'name'     => 'about',
					'required' => false,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
// 					'validators' => array(
// 							array(
// 									'name'    => 'StringLength',
// 									'options' => array(
// 											'encoding' => 'UTF-8',
// 											'min'      => 1,
// 											'max'      => 500,
// 									),
// 							),
// 					),
			));
			
			



	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
	
	
}