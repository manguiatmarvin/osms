<?php
namespace Hr\Model;


class EmployeeMemo{
	public $id;
	public $title;
	public $filename;
	public $issue_date;
	public $issued_to;
	public $issued_by;
	
	//input filter
	private $inputFilter;

	public function exchangeArray($data){
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->title = (!empty($data['title'])) ? $data['title'] : null;
		$this->filename = (!empty($data['filename'])) ? $data['filename'] : null;
		$this->issue_date  = (!empty($data['issue_date'])) ? $data['issue_date'] : null;
		$this->issued_to = (!empty($data['issued_to'])) ? $data['issued_to'] : null;
		$this->issued_by = (!empty($data['issued_by'])) ? $data['issued_by'] : null;
	}
	
	// Add the following method:
	public function getArrayCopy(){
		return get_object_vars($this);
	}
	
}