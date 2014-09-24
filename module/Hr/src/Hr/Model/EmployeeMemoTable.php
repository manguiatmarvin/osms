<?php

namespace Hr\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Hr\Model\EmployeeMemo;


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
	
	/**
	 * delete a memo file from memo table
	 * 
	 * @param unknown $memo_id        	
	 */
	public function deleteEmployeeMemo($memo_id) {
		$this->tableGateway->delete ( array (
				'id' => $memo_id 
		) );
	}
	
    /**
     * get single row from employee memo table using memo id
     */
    public function getEmployeeMemoSingle($id){
    	$rowSet = $this->tableGateway->select(array('id'=>$id));
       return $rowSet->current();
    }
    
    public function saveEmployeeMemo(EmployeeMemo $eMemo){
    	$data  = array('id'=>$eMemo->id,
    	                'title'=>$eMemo->title,
    	                'filename'=>$eMemo->filename,
    	                'issue_date'=>date("Y-m-d H:i:s"),
    	                'issued_to'=>$eMemo->issued_to,
    			        'issued_by'=>$eMemo->issued_by);
   
    	$id = (int) $eMemo->id;
    	
    	if ($id == 0) {
    		// if id is null or empty save a new record
    		$this->tableGateway->insert($data);
    		
    		
    	} else {
    		//otherwire this update the recod
    		
    		if ($this->getEmployeeMemoSingle($id)) {
    			$this->tableGateway->update($data, array('id' => $id));
    		} else {
    			throw new \Exception('id does not exist');
    		}
    	}
    	
    }


}