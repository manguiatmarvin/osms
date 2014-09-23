<?php

namespace Hr\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class EmployeeMemoTable {
	
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
	
	/**
	 * testing 
	 * @return string
	 */
	public function test(){
		return "Success!";
	}
	

	/*
	 * get list of employee memo using emp_id
	 * 
	 */
	

	public function getEmployeeMemo($emp_id){
	  $rowSet = $this->tableGateway->select(array('issued_to'=>$emp_id));
	  return $rowSet->toArray();
	}


	

	

	

  
	

}