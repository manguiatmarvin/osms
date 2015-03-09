<?php

namespace Hr\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class EmployeeSalaryTable {
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
	


	public function getEmployeeSalary($emp_id){
		
		$select = new Select('employee_salary');
		$select->where(array('employee_id'=>$emp_id));
			
		$select->order(array('created DESC','id DESC')); // produces 'name' ASC, 'age' DESC
		
		$paginatorAdapter = new DbSelect(
				// our configured select object
				$select,
				// the adapter to run it against
				$this->tableGateway->getAdapter(),
				// the result set to hydrate
				new ResultSet () );
		
		$paginator = new Paginator ( $paginatorAdapter );
		$paginator->setItemCountPerPage(5);
		return $paginator;
	}
	
	
	
}