<?php

namespace Profile\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Filter\DateTimeFormatter;
use Profile\Model\Password;

class ProfileTable {
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
	
	
	
	public function updateProfilePicture($users_id,$image_file){
	
		if(empty($users_id) && empty($image_file)){
			throw new \Exception ( 'Profile id, or iamge file  does not exist' );
		}
		
		
		$data = array (
				'profile_pic_url' => $image_file,
				);
		

	   $this->tableGateway->update ( $data, array (
						'users_id' => $users_id
				) );
		
	   return true;
		
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
     	                      user_profile.created,
     	                      user_profile.profile_pic_url,
     	                      DATE_FORMAT(user_profile.last_modified,'%b %d, %Y @ %h:%i %p') as last_modified
     			         FROM users LEFT JOIN user_profile 
                          ON  users.id = user_profile.users_id 
     			        WHERE users.user_name =  '{$username}'";
		
		$statement = $dbAdapter->query ( $sql );
		$result = $statement->execute ();
		return $result->current ();
	}
	public function getProfileById($id){
		$id = ( int ) $id;
	   $dbAdapter = $this->tableGateway->getAdapter ();
		// custom query
		$sql = "SELECT  users.user_name,
		user_profile.id,
		user_profile.users_id,
		user_profile.firstname,
		user_profile.lastname,
		user_profile.middle,
        DATE_FORMAT(user_profile.birthdate,'%m/%d/%Y') as birthdate,
		user_profile.gender_id,
		user_profile.about,
		user_profile.address,
		user_profile.landline,
		user_profile.cellphone,
		user_profile.created,
		user_profile.profile_pic_url,
		DATE_FORMAT(user_profile.last_modified,'%b %d, %Y @ %h:%i %p') as last_modified
		FROM users LEFT JOIN user_profile
		ON  users.id = user_profile.users_id
		WHERE users.id  = $id";
		
		$statement = $dbAdapter->query ( $sql );
		$result = $statement->execute ();
		$row =  $result->current ();
		if (! $row) {
			throw new \Exception ( "Could not find row $id" );
		}
		
		$profileObj = new Profile();
		$profileObj->exchangeArray($row);
		return $profileObj;
		
	}
	public function saveProfile(Profile $profile) {
		 //date formatting 
		$today = date( "Y-m-d H:i:s" );
		$bdate = new \DateTime($profile->birthdate);
		$bdate = $bdate->format("Y-m-d"); 
		
		$data = array (
				'firstname' => $profile->firstname,
				'lastname' => $profile->lastname,
				'middle' => $profile->middle,
				'birthdate' => $bdate,
				'gender_id' => $profile->gender_id,
				'about' => $profile->about,
				'address' => $profile->address,
				'landline' => $profile->landline,
				'cellphone' => $profile->cellphone,
				'last_modified' => $today 
		);
		
		$id = ( int ) $profile->id;
		if ($id == 0) {
			$this->tableGateway->insert ( $data );
		} else {
			if ($this->getProfileById ( $id )) {
				$this->tableGateway->update ( $data, array (
						'id' => $id 
				) );
			} else {
				throw new \Exception ( 'Profile id does not exist' );
			}
		}
	}
	
	
	/**
	 *
	 * @return array of category
	 */
	public function getGenderArray() {
	
		$dbAdapter = $this->tableGateway->getAdapter();
		$sql = 'SELECT * from gender ';
		$statement = $dbAdapter->query($sql);
		$result = $statement->execute();
	
		$selectData = array();
	
		foreach ($result as $res) {
	
			$selectData[$res['id']] = $res['gender'];
		}
	
		return $selectData;
	}
	
	public function getPasswordDetails($user_id){
		$dbAdapter = $this->tableGateway->getAdapter();
		$sql = "Select users.id, users.user_name, users.pass_word as pass_word
				From users 
				Where users.id = {$user_id}";
		
		$statement = $dbAdapter->query($sql);
		$result = $statement->execute();
		
		$data = $result->current();
		$pasword = new Password();
	
	     foreach($data as $val){
	     	$pasword->users_id = $data['id'];
	     	$pasword->oldPassword = $data['pass_word'];
	     }
		
		return $pasword;
	}
	
	/**
	 * return : 0 or 1 defending on the update result
	 * @param unknown $userName
	 * @param unknown $oldPassword
	 * @param unknown $newPassword
	 */
	public function updatePassword($userName,$oldPassword,$newPassword){
		$dbAdapter = $this->tableGateway->getAdapter();
		$sql = "SELECT `users`.*, 
				(CASE WHEN `pass_word` = '{$oldPassword}' 
				 THEN 1 ELSE 0 END) 
			     AS `zend_auth_credential_match` 
			   FROM `users` WHERE `user_name` = '{$userName}'";

		$statement = $dbAdapter->query($sql);
		$selectResult = $statement->execute();
		
		$data = $selectResult->current();
		//update if exist
		if ('1' === $data['zend_auth_credential_match']){
		      //TODO: need to clean the data b4 saving to database
			
			$statement = $dbAdapter->query("Update users set pass_word = '{$newPassword}' 
			                                WHERE users.id = {$data['id']} AND 
			                                      users.user_name = '{$data['user_name']}'");
			$updateResult = $statement->execute();
			
		  return $updateResult->getAffectedRows();
		 
		}
		
	}
	
	public function deleteProfile($id) {
		$this->tableGateway->delete ( array (
				'id' => ( int ) $id 
		) );
	}
}