<?php
namespace Hr\Model;


class EmployeeSalary{
	public $id;
	public $employee_id;
	public $salary;
	public $created;
	public $modfied;
	
	//input filter
	private $inputFilter;

	public function exchangeArray($data){
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->salary  = (!empty($data['salary'])) ? $data['salary'] : null;
		$this->employee_id = (!empty($data['employee_id'])) ? $data['employee_id'] : null;
		$this->created = (!empty($data['created'])) ? $data['created'] : null;
		$this->modfied = (!empty($data['modfied'])) ? $data['modfied'] : null;
	}
	
	// Add the following method:
	public function getArrayCopy(){
		return get_object_vars($this);
	}
	
}