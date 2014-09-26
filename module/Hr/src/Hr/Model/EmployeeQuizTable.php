<?php

namespace Hr\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class EmployeeQuizTable {
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	public function getTableGateway() {
		return $this->tableGateway;
	}
	public function setTablegateway(TableGateway $tableGateway) {
		if (null == $this->tableGateway) {
			$this->tableGateway = $tableGateway;
		}
	}

	public function getEmployeeQuiz($emp_id){
		$rowSet = $this->tableGateway->select(array('employee_id'=>$emp_id));
		return (array)$rowSet->toArray();
	}
	
	public function deleteEmployeeQuiz($id){
		$this->tableGateway->delete(array('id' => (int)$id));
	}
	
	public function getEmployeeQuizSingle($id){
		$rowSet = $this->tableGateway->select(array('id'=>$id));
		return $rowSet->current();
	}
	
	public function saveEmployeeQuiz(EmployeeQuiz $eq){
		$data = array('id'=>$eq->id,
		              'title'=>$eq->title,
		              'score'=>$eq->score,
		              'employee_id'=>$eq->employee_id,
		              'created'=>$eq->created!=null ? $eq->created: date("Y-m-d H:i:s"),
		              'modified'=>$eq->modified!=null ? $eq->modified: date("Y-m-d H:i:s"));
	 
		$id = (int) $eq->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getEmployeeQuizSingle($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception(' id does not exist');
			}
		}
	  
	}
	
}