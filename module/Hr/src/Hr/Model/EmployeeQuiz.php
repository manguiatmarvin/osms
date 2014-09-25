<?php
namespace Hr\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class EmployeeQuiz implements InputFilterAwareInterface
{
	public $id;
	public $title;
	public $score;
	public $employee_id;
	public $created;
	public $modified;
	
	protected $inputFilter;

	
	public function exchangeArray($data)
	{
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->title  = (!empty($data['title'])) ? $data['title'] : null;
		$this->score = (!empty($data['score'])) ? $data['score'] : null;
		$this->created = (!empty($data['created'])) ? $data['created'] : null;
		$this->employee_id = (!empty($data['employee_id'])) ? $data['employee_id'] : null;
		$this->modified = (!empty($data['modified'])) ? $data['modified'] : null;
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
					'name'     => 'title',
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
	
			$inputFilter->add(array(
					'name'     => 'score',
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