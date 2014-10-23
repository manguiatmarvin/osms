<?php
namespace Hr\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class EmployeeEvaluations{
	public $id;
	public $title;
	public $notes;
	public $score;
	public $accepted;
	public $employee_id;
	public $evaluated_by;
	public $created;
	public $evaluation_due;
	public $modfied;
	
	//input filter
	protected $inputFilter;

	public function exchangeArray($data){
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->title = (!empty($data['title'])) ? $data['title'] : null;
		$this->notes = (!empty($data['notes'])) ? $data['notes'] : null;
		$this->score = (!empty($data['score'])) ? $data['score'] : null;
		$this->accepted  = (!empty($data['accepted'])) ? $data['accepted'] : null;
		$this->employee_id = (!empty($data['employee_id'])) ? $data['employee_id'] : null;
		$this->evaluated_by = (!empty($data['evaluated_by'])) ? $data['evaluated_by'] : null;
		$this->created = (!empty($data['created'])) ? $data['created'] : null;
		$this->evaluation_due = (!empty($data['evaluation_due'])) ? $data['evaluation_due'] : null;
		$this->modfied = (!empty($data['modfied'])) ? $data['modfied'] : null;
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
			
			$this->inputFilter = $inputFilter;
			
		}
		
		return $this->inputFilter;
	}
}