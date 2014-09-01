<?php

namespace Profile\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

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
	public function getProfileById($id) {
		$id = ( int ) $id;
		$rowset = $this->tableGateway->select ( array (
				'id' => $id 
		) );
		$row = $rowset->current ();
		if (! $row) {
			throw new \Exception ( "Could not find row $id" );
		}
		return $row;
	}
	public function saveProfile(Profile $profile) {
		$today = date ( "Y-m-d H:i:s" );
		
		$data = array (
				'firstname' => $profile->firstname,
				'lastname' => $profile->lastname,
				'middle' => $profile->middle,
				'birthdate' => $profile->birthdate,
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
	
	public function deleteProfile($id) {
		$this->tableGateway->delete ( array (
				'id' => ( int ) $id 
		) );
	}
}