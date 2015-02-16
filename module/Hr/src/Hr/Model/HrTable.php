<?php
namespace Hr\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

 class HrTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }
     
     public function getTableGateway(){
      return $this->tableGateway;
     }
     
     public function setTablegateway(TableGateway $tableGateway){
     	if(null == $this->tableGateway){
     		$this->tableGateway = $tableGateway;
     	}
     }

     public function fetchAll(){
     	

//      	SELECT employees.id, employees.date_hired, employees.status, user_profile.firstname, user_profile.lastname, user_profile.middle, user_profile.birthdate, user_profile.address, user_profile.landline, user_profile.cellphone, user_profile.birthdate, user_profile.profile_pic_url
//      	FROM employees
//      	LEFT JOIN user_profile ON employees.users_id = user_profile.users_id
     	
      
            // create a new Select object for the table album
            $select = new Select('employees');
            
            $select->join('user_profile', // table name,
            		'employees.users_id = user_profile.users_id', // expression to join on (will be quoted by platform object before insertion),
            		array('firstname',
            			  'lastname','middle','birthdate','address','landline','cellphone','about','created','last_modified','profile_pic_url'), // (optional) list of columns, same requiremetns as columns() above
            		Select::JOIN_LEFT // (optional), one of inner, outer, left, right also represtned by constants in the API
            );
            
            $paginatorAdapter = new DbSelect(
                // our configured select object
                $select,
                // the adapter to run it against
                $this->tableGateway->getAdapter(),
                // the result set to hydrate
                new ResultSet () );
		
		$paginator = new Paginator ( $paginatorAdapter );
		return $paginator;
	}
	
	
	
	public function fetchAllStaffsByClientId($client_id){
	
	
		//      	SELECT employees.id, employees.date_hired, employees.status, user_profile.firstname, user_profile.lastname, user_profile.middle, user_profile.birthdate, user_profile.address, user_profile.landline, user_profile.cellphone, user_profile.birthdate, user_profile.profile_pic_url
		//      	FROM employees
		//      	LEFT JOIN user_profile ON employees.users_id = user_profile.users_id
	
	
		// create a new Select object for the table album
		$select = new Select('employees');
	
		$select->join('user_profile', // table name,
				'employees.users_id = user_profile.users_id', // expression to join on (will be quoted by platform object before insertion),
				array('firstname',
						'lastname','middle','birthdate','address','landline','cellphone','about','created','last_modified','profile_pic_url'), // (optional) list of columns, same requiremetns as columns() above
				Select::JOIN_LEFT // (optional), one of inner, outer, left, right also represtned by constants in the API
		);
	
		$paginatorAdapter = new DbSelect(
				// our configured select object
				$select,
				// the adapter to run it against
				$this->tableGateway->getAdapter(),
				// the result set to hydrate
				new ResultSet () );
	
		$paginator = new Paginator ( $paginatorAdapter );
		return $paginator;
	}
	
	
	
	public function getPreEmployedList(){
	
		// create a new Select object for the table album
		$select = new Select('user_profile');
	
		$select->join('employees', // table name,
				'employees.users_id = user_profile.users_id', // expression to join on (will be quoted by platform object before insertion),
				array('u_id'=>'id'),// (optional) list of columns, same requiremetns as columns() above
				Select::JOIN_LEFT // (optional), one of inner, outer, left, right also represtned by constants in the API
		);
		
		$select->where(array('employees.users_id IS NULL'));
		
		
	
		$paginatorAdapter = new DbSelect(
				// our configured select object
				$select,
				// the adapter to run it against
				$this->tableGateway->getAdapter(),
				// the result set to hydrate
				new ResultSet () );
	
		$paginator = new Paginator ( $paginatorAdapter );
		return $paginator;
	}
	
	
	/**
	 * get Empoyee details 
	 * @param unknown $emp_id
	 * @return mixed|NULL
	 */
	public function getEmployeePersonal($emp_id) {
		if ($emp_id != "") {
			
			$dbAdapter = $this->tableGateway->getAdapter ();
			$sql = "SELECT   employees.id, 
			                 employees.users_id,
     			             employees.date_hired, 
     			             employees.status,
     			             user_profile.firstname, 
     			             user_profile.lastname, 
     			             user_profile.middle, 
     			             DATE_FORMAT(user_profile.birthdate,'%b %d, %Y') as birthdate,
     			             user_profile.address, 
     			             user_profile.landline, 
     			             user_profile.cellphone, 
     			             user_profile.birthdate, 
     			             user_profile.profile_pic_url,
     			             user_profile.about,
     			             DATE_FORMAT(user_profile.created,'%b %d, %Y') as created,
     			             DATE_FORMAT(user_profile.last_modified,'%b %d, %Y @ %h:%i %p') as last_modified,
     			             DATEDIFF(CURRENT_DATE, employees.date_hired)/365 AS years_of_service
     	                FROM employees
     	           LEFT JOIN user_profile 
     			          ON employees.users_id = user_profile.users_id
     			        WHERE employees.id = {$emp_id}";
     	$statement = $dbAdapter->query($sql);
     	$result    = $statement->execute();
     	return $result->current();
     	}
       return null;
     }
     
     
     public function getEmployeeFiles($emp_id) {
     	if ($emp_id != "") {
     			
     		$dbAdapter = $this->tableGateway->getAdapter ();
     		$sql = "SELECT employee_files.id,
     		              employee_files.file_type_id,
     		              employee_files.filename,
     		              employee_files.description,
     		              employee_files.added,
     		              employee_filetypes.file_type_name 
     		        FROM employee_files 
     		        LEFT JOIN employee_filetypes 
     		        ON  employee_files.file_type_id = employee_filetypes.id 
     		WHERE employee_files.employee_id = {$emp_id} LIMIT 10";
			$statement = $dbAdapter->query ( $sql );
			$result = $statement->execute ();
			return $result;
		}
		return null;
	}
	
	/*
	 * get 10 latest emp memo
	 */
	public function getEmployeeMemo($emp_id) {
		$dbAdapter = $this->tableGateway->getAdapter ();
		
		$sql = "SELECT * from employee_memo WHERE issued_to = ".$emp_id." limit 10";
     			$statement = $dbAdapter->query($sql);
     			$result    = $statement->execute();
     			
     	return $result;
     		}
     		
     		

     		/*
     		 * get 10 latest emp quiz
     		*/
     		public function getEmployeeQuiz($emp_id) {
     			$dbAdapter = $this->tableGateway->getAdapter ();
     		
     			$sql = "SELECT * from employee_quiz WHERE employee_id = ".$emp_id." limit 10";
     			$statement = $dbAdapter->query($sql);
     			$result    = $statement->execute();
     		
     			return $result;
     		}
     	
     	
     	
     	public function getEmployeeWorkDetails($emp_id) {
     		if ($emp_id != "") {
     	
     			$dbAdapter = $this->tableGateway->getAdapter ();
     			$sql = "SELECT employee_files.id,
     			employee_files.file_type_id,
     			employee_files.filename,
     			employee_files.description,
     			employee_files.added,
     			employee_filetypes.file_type_name
     			FROM employee_files
     			LEFT JOIN employee_filetypes
     			ON  employee_files.file_type_id = employee_filetypes.id
     			WHERE employee_files.employee_id = {$emp_id}";
     			$statement = $dbAdapter->query ( $sql);
			$result = $statement->execute ();
			return $result;
		}
		return null;
	}
	
	/**
	 *
	 * @param unknown $emp_id        	
	 * @return unknown|NULL
	 */
	public function getEmployeeSalaryHistory($emp_id) {
		$emp_id = ( int ) $emp_id;
		
		$salary = array ();
		$salary ['current'] = null;
		$salary ['previous'] = null;
		$salary ['last_race_date'] = null;
		
	    if (!$emp_id) {
             throw new \Exception("Invalid employee Id  $emp_id");
         }
			
			$dbAdapter = $this->tableGateway->getAdapter ();
			
			$sql = "SELECT * FROM employee_salary 
                    WHERE employee_salary.employee_id = $emp_id 
                    ORDER BY employee_salary.created 
			        DESC LIMIT 2";
			
     				$statement = $dbAdapter->query($sql);
     				$result    = $statement->execute();
     				
     				
     				$current =  $result->current();
     				$previous = $result->next();
     				
     				$salary ['current'] = $current["salary"];
     				$salary ['previous'] = $previous["salary"];
     				$salary ['last_race_date'] = $previous["created"];
     			
     			return $salary;
     }
     
     public function getEmployeeEvaluationDue($emp_id){
     	$emp_id = ( int ) $emp_id;
     	if (!$emp_id) {
     		throw new \Exception("Invalid employee Id  $emp_id");
     	}
     	
     	$dbAdapter = $this->tableGateway->getAdapter();
     		
     	$sql = "SELECT * FROM employee_evaluation
                WHERE employee_evaluation.status = 'pending' 
                AND employee_evaluation.employee_id = $emp_id
                ORDER BY employee_evaluation.evaluation_due DESC
     			LIMIT 1";
     
     		
     	$statement = $dbAdapter->query($sql);
     	$result    = $statement->execute();
     	return $result->current();
     }
     
     
     public function getEmployeeLatestPosition($emp_id){
     	$emp_id = ( int ) $emp_id;
     	if (!$emp_id) {
     		throw new \Exception("Invalid employee Id  $emp_id");
     	}
     
     	$dbAdapter = $this->tableGateway->getAdapter();
     	 
     	$sql = "SELECT employee_position.created,
                       positions.position_name,
                       positions.id
                  FROM employee_position
                  LEFT JOIN positions
                  ON positions.id = employee_position.position_id
                WHERE employee_position.employee_id = $emp_id
              ORDER BY employee_position.created DESC LIMIT 1";
     	 
     	$statement = $dbAdapter->query($sql);
     	$result    = $statement->execute();
     	return $result->current();
     }
     
     /**
      * Send Email
      *
      * Sends plain text emails
      *
      */
     private function sendEmail($to = '', $subject = '', $messageText = '')
     {
     	$transport = $this->getServiceLocator()->get('mail.transport');
     	$message = new Message();
     
     	$message->addTo($to)
     	->addFrom($this->getOptions()->getSenderEmailAdress())
     	->setSubject($subject)
     	->setBody($messageText);
     
     	$transport->send($message);
     }
     

     
   /**
    * id is the id from employee table not the employee id
    * @param unknown $id
    */
    public function getEmployee($id){

    	$id  = (int) $id;
    	
    	$rowset = $this->tableGateway->select(array('id' => $id));
    	
		$row = $rowset->current ();
		
		if (! $row) {
			throw new \Exception ( "Could not find row $id" );
		}
		return $row;
	}
	
	public function getEmployeeByEmpId($id){
		
		$dbAdapter = $this->tableGateway->getAdapter();
		 
		$sql = "SELECT employees.id,
                       user_profile.firstname,
                       user_profile.lastname,
                       user_profile.id as profileId
                  FROM employees LEFT JOIN user_profile
                    ON employees.users_id = user_profile.users_id
                 WHERE employees.id = {$id} LIMIT 1";
		 
		$statement = $dbAdapter->query($sql);
		$result    = $statement->execute();
		return $result->current();
		
	}

	
	
	public function saveEmployee($empObj) {
	
		if(null==$empObj)return;
		
		$datehired = new \DateTime($empObj->date_hired);
		$datehired = $datehired->format("Y-m-d");
		$status = (int)$empObj->status;
        $userId = (int)$empObj->users_id;
		
		$dbAdapter = $this->tableGateway->getAdapter ();
			$sql = "UPDATE employees set date_hired = '{$datehired}',
			                status = $status 
			         WHERE employees.users_id = $userId";
			
     	$statement = $dbAdapter->query($sql);
     	$result    = $statement->execute();
     	return $result->getAffectedRows();
    }
    
     public function deleteAlbum($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }