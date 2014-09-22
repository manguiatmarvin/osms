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
			$select = new Select('employee_files');
			$select->join('employee_filetypes', // table name,
				'employee_files.file_type_id = employee_filetypes.id', // expression to join on (will be quoted by platform object before insertion),
				array('file_type'=>'file_type_name'), // (optional) list of columns, same requiremetns as columns() above
				Select::JOIN_LEFT // (optional), one of inner, outer, left, right also represtned by constants in the API
		)->where(array('employee_files.employee_id'=>$emp_id));
			
			$select->order(array('added ASC',)); // produces 'name' ASC, 'age' DESC
		
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
	
	
	public function saveEmpoyeeFile(EmployeeFile $efile){
		
		$data = array(
				'id'=>$efile->id,
				'file_type_id' => $efile->file_type_id,
				'filename'  => $efile->filename,
				'description' => $efile->description,
				'employee_id' => $efile->employee_id,
				'added' => ($efile->added !=null) ? $efile->added : date("Y-m-d H:i:s") 
		);
		
	
		
		$id = (int) $efile->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getSingleEmployeeFile($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('File id does not exist');
			}
		}
	}
	
    /**
     * get specific employee file from file table
     * @param unknown $emp_id
     * @param unknown $file_id
     */
	public function getSingleEmployeeFile($emp_id,$file_id){
		$rowSet = $this->tableGateway->select(array('employee_id'=>$emp_id,
				'id' => (int)$file_id));
		
		return $rowSet->current();
		
	}
	
     /**
      * delete single employee file 
      * id  - this is the id of file
      * emp_id
      * @param unknown $id
      */
	public function deleteEmployeeFile($emp_id,$id){
		{
			$this->tableGateway->delete(array('employee_id'=>$emp_id,
					                                   'id' => (int)$id));
		}
	}
	

  
	

}