<?php
namespace Album\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

 class UsersDAO
 {


     
     
     public function selectWhereTitleIs2($title=""){
     	if($title!="") {
     		// create a new Select object for the table album
     		$select = new Select('album');
     		$select->where->like('title', $title.'%');
     		// create a new result set based on the Album entity
     		//$resultSetPrototype = new ResultSet();
     		//$resultSetPrototype->setArrayObjectPrototype(new Album());
     		// create a new pagination adapter object
     		$paginatorAdapter = new DbSelect(
     				// our configured select object
     				$select,
     				// the adapter to run it against
     				$this->tableGateway->getAdapter(),
     				// the result set to hydrate
     				new ResultSet()
     		);
     		$paginator = new Paginator($paginatorAdapter);
     		return $paginator;
     	}
       return null;
     }
     
 }