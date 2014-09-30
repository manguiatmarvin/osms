<?php

namespace Hr\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Hr\Model\EmployeeLogins;


class EmployeeLoginsTable {
	
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
	
	
	public function getEmployeeAttendance($emp_id){
		
		$id = (int) $emp_id;
		if(!$id){
			throw new \Exception('invalid Id');
		}
		
		$select = new Select('employee_logins');
		$select->where(array('employee_id'=>$id));
			
		$select->order(array('time DESC',)); // produces 'name' ASC, 'age' DESC
		
		$paginatorAdapter = new DbSelect(
				// our configured select object
				$select,
				// the adapter to run it against
				$this->tableGateway->getAdapter(),
				// the result set to hydrate
				new ResultSet () );
		
		$paginator = new Paginator ( $paginatorAdapter );
		$paginator->setItemCountPerPage(15);
		return $paginator;
	}
	
	public function loginLogoutEmployee(EmployeeLogins $el){
		$ip  = get_client_ip();
		$data = array('employee_id'=>$el->employee_id,
		              'ip_address'=>$ip,
		               'time'=>date("Y-m-d H:i:s"),
		               'log_type'=>$el->log_type);
		
		$this->tableGateway->insert($data);
	}
	
	/*
	 * get list of employee memo using emp_id
	 * 
	 */

// 	public function getEmployeeMemo($emp_id){
// 		$select = new Select('employee_memo');
// 		$select->where(array('issued_to'=>$emp_id));
			
// 		$select->order(array('issue_date ASC',)); // produces 'name' ASC, 'age' DESC
		
// 		$paginatorAdapter = new DbSelect(
// 				// our configured select object
// 				$select,
// 				// the adapter to run it against
// 				$this->tableGateway->getAdapter(),
// 				// the result set to hydrate
// 				new ResultSet () );
		
// 		$paginator = new Paginator ( $paginatorAdapter );
// 		$paginator->setItemCountPerPage(5);
// 		return $paginator;
// 	}
	
    
	private function get_client_ip() {
		$ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}


}