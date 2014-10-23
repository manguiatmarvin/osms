<?php
namespace Hr\Model;


class EmployeeEvaluations{
	public $id;
	public $title;
	public $score;
	public $accepted;
	public $employee_id;
	public $evaluated_by;
	public $created;
	public $modfied;
	
	//input filter
	private $inputFilter;

	public function exchangeArray($data){
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->title = (!empty($data['title'])) ? $data['title'] : null;
		$this->score = (!empty($data['score'])) ? $data['score'] : null;
		$this->accepted  = (!empty($data['accepted'])) ? $data['accepted'] : null;
		$this->employee_id = (!empty($data['employee_id'])) ? $data['employee_id'] : null;
		$this->evaluated_by = (!empty($data['evaluated_by'])) ? $data['evaluated_by'] : null;
		$this->created = (!empty($data['created'])) ? $data['created'] : null;
		$this->modfied = (!empty($data['modfied'])) ? $data['modfied'] : null;
	}
	
	// Add the following method:
	public function getArrayCopy(){
		return get_object_vars($this);
	}
	
}