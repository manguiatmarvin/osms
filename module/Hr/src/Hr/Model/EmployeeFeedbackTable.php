<?php
namespace Hr\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Db\Sql\Expression;

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
	
	/**
	 * SELECT 
t.id,
t.feedback,
t.create_date,
users.role 
FROM employee_feedback t 
LEFT JOIN users 
ON t.from_user_id = users.id
where
  t.create_date  >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), INTERVAL 1 DAY) 

order by users.role DESC, 

	 * @param unknown $emp_id
	 */
	public function getEmployeeFeedBack($emp_id){
		$select =  new Select('employee_feedback');
		$select->join('users',
				      'employee_feedback.from_user_id = users.id', 
				      array('users_id'=>'id','role'),
				      $select::JOIN_LEFT);
		$select->join('user_profile',
		              'users.id = user_profile.users_id',
		               array('firstname','lastname'),$select::JOIN_LEFT);
		
		$select->where('employee_feedback.create_date  >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), INTERVAL 1 DAY)');
		$select->where('employee_feedback.to_employee_id = '.$emp_id);
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
	
	/**
	 * testing
	 * @return string
	 */
	public function test(){
		return "Success!";
	}
	

	

	
	

	
}