<?php
namespace Hr\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class EmployeeFeedbackTable {
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
	
	public function getEmployeeFeedBack($emp_id){
		
		$rowSet = $this->tableGateway->select(array('id'=>$emp_id));
		return $rowSet->current();
	}
	
	/**
	 * testing
	 * @return string
	 */
	public function test(){
		return "Success!";
	}
	

	

	
	

	
}