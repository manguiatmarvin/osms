<?php
namespace SanAuth\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

 class SanAuthTable
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
     /**
      * 
      * $log_type = 1 for in 0 for out
      * @param unknown $emp_id
      * @param unknown $log_type
      */
     public function logInLogOut($users_id,$log_type){
     	$dbAdapter = $this->tableGateway->getAdapter ();
     	
     	$emp_id = $this->getEmployeeId($users_id);
     	
     	$ip = $this->get_client_ip();
     	$time = date("Y-m-d H:i:s");
     	
     	
     	
     	$sql = "Insert Into employee_logins set employee_id = {$emp_id}, 
     	                                        ip_address = '{$ip}',
     	                                        time= '{$time}',
     	                                        log_type = {$log_type}";
     	
     	$statement = $dbAdapter->query ( $sql );
     	$statement->execute ();
     }
     
     /*
      * yes.. users_id is different from employee id
      */
     public function getEmployeeId($users_id){
     	$dbAdapter = $this->tableGateway->getAdapter ();
     	$statement = $dbAdapter->query ( "Select * from employees where users_id = {$users_id}");
     	$rowSet = $statement->execute ()->current();
        return $rowSet["id"];
        
     }


     public function getProfileInfoByUserName($username) {
     	// get DB adapter
     	$dbAdapter = $this->tableGateway->getAdapter ();
     	// custom query
     	$sql = "SELECT  users.user_name,
     	user_profile.id,
     	user_profile.users_id,
     	user_profile.firstname,
     	user_profile.lastname,
     	user_profile.middle,
     	user_profile.birthdate,
     	user_profile.gender_id,
     	user_profile.about,
     	user_profile.address,
     	user_profile.landline,
     	user_profile.cellphone,
     	DATE_FORMAT(user_profile.created,'%b %d, %Y') as created,
     	user_profile.profile_pic_url,
     	DATE_FORMAT(user_profile.last_modified,'%b %d, %Y @ %h:%i %p') as last_modified
     	FROM users LEFT JOIN user_profile
     	ON  users.id = user_profile.users_id
     	WHERE users.user_name =  '{$username}'";
     
     	$statement = $dbAdapter->query ( $sql );
     	$result = $statement->execute ();
     	return $result->current();
     }
    
     
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