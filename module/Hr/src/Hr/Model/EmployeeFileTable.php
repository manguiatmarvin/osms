<?php

namespace Hr\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class EmployeeFileTable {
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

	
	public function getEmployeeFiles($emp_id){
			$select = new Select('employee_filetypes');
		
		$select->join('employee_files', // table name,
				'employee_files.file_type_id = employee_filetypes.id', // expression to join on (will be quoted by platform object before insertion),
				array('description','added','employee_id','filename'), // (optional) list of columns, same requiremetns as columns() above
				Select::JOIN_LEFT // (optional), one of inner, outer, left, right also represtned by constants in the API
		);            
		
		$select->where(array('employee_id'=>$emp_id));
		
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
	
	
	public function saveEmpoyeeFile(EmployeeFile $file){
		
	}
	

	

	
	

  
	

}