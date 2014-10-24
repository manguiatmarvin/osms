<?php
namespace Hr\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class EmployeeEvaluationsTable {
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
	
	
	public function saveEmployeeEvaluation(EmployeeEvaluations $ea){
		$data = array('id'=>$ea->id,
		               'title'=>$ea->title,
		               'notes'=>$ea->notes,
		               'score'=>$ea->score,
		               'employee_id'=>$ea->employee_id,
		               'created'=>$ea->created,
		               'evaluated_by'=>$ea->evaluated_by,
		               'evaluation_due'=>$ea->evaluation_due,
		               'modified'=>date("Y-m-d H:i:s"));
		
		$id = (int) $ea->id;
		if($id==0){
			//add
			$this->tableGateway->insert($data);
		}else{
			//update
			if($this->getEmployeeEvaluationSingle($id)){
				$this->tableGateway->update($data, array('id'=>$id));
			}
			
		}
		
	}
	
	public function getEmployeeEvaluationSingle($id){
		$rowSet =  $this->tableGateway->select(array('id'=>$id));
		return $rowSet->current();
	}
	public function getEmployeeEvaluations($emp_id){
		
		$select = new Select('employee_evaluation');	
		$select->where(array('employee_evaluation.employee_id'=>$emp_id));
		$select->order(array('created ASC','id ASC')); // produces 'name' ASC, 'age' DESC
		
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