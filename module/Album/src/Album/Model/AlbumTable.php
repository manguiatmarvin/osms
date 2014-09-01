<?php
namespace Album\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

 class AlbumTable
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

     public function fetchAll($paginated=false){
          if($paginated) {
            // create a new Select object for the table album
            $select = new Select('album');
            
            $select->join('categories', // table name,
            		'album.category_id = categories.id', // expression to join on (will be quoted by platform object before insertion),
            		array('category'), // (optional) list of columns, same requiremetns as columns() above
            		Select::JOIN_LEFT // (optional), one of inner, outer, left, right also represtned by constants in the API
            );
            
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
        $resultSet = $this->tableGateway->select();
        return $resultSet;
     }
     
     
     public function selectWhereTitleIs($title=""){
     	if($title!="") {
     	
     		// create a new Select object for the table album
     		$select = new Select('album');
     		 
     		$r = $select->join('categories', // table name,
     				'album.category_id = categories.id', // expression to join on (will be quoted by platform object before insertion),
     				array('category'), // (optional) list of columns, same requiremetns as columns() above
     				Select::JOIN_LEFT // (optional), one of inner, outer, left, right also represtned by constants in the API
     		)->where->like('title', $title.'%');
     		
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
     
     /**
      * 
      * @return array of category
      */
     public function getCategoryArray(){
     	
     	$dbAdapter = $this->tableGateway->getAdapter();
     	$sql       = 'SELECT * from categories ';
     	$statement = $dbAdapter->query($sql);
     	$result    = $statement->execute();
     	
     	$selectData = array();
     	
     	foreach ($result as $res) {
     	
     		$selectData[$res['id']] = $res['category'];
     	}
     	
     	return $selectData;
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
      
     

     public function getAlbum($id){
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveAlbum(Album $album)
     {
         $data = array(
             'artist' => $album->artist,
             'title'  => $album->title,
         	 'category_id' =>$album->category_id
         );

         $id = (int) $album->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getAlbum($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Album id does not exist');
             }
         }
     }
     


     public function deleteAlbum($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }