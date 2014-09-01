<?php 
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Album;          // <-- Add this import
use Album\Form\AlbumForm;       // <-- Add this import

class AlbumController extends AbstractActionController
{
	
	protected $albumTable;
	
	
	public function indexAction()
	{
		
	// grab the paginator from the AlbumTable
    $paginator = $this->getAlbumTable()->fetchAll(true);
    // set the current page to what has been passed in query string, or to 1 if none set
    $paginator->setCurrentPageNumber((int)$this->params()->fromQuery('page', 1));
    // set the number of items per page to 10
    $paginator->setItemCountPerPage(5);

    return new ViewModel(array(
        'paginator' => $paginator
    ));
	}

	public function addAction()
	{
		//if not logged in, redirect to login page
		if (! $this->getServiceLocator()
		->get('AuthService')->hasIdentity()){
			return $this->redirect()->toRoute('login');
		}
		
		$alForm = new AlbumForm();
		$catOptions = $this->getAlbumTable()->getCategoryArray();
		$alForm->setOptionSelect($catOptions);
		$alForm->initialize();
		
		$alForm->get('submit')->setValue('Add');
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			
		
			$album = new Album();
			$alForm->setInputFilter($album->getInputFilter());
			$alForm->setData($request->getPost());
		
			if ($alForm->isValid()) {
				$alForm->exchangeArray($alForm->getData());
				$this->getAlbumTable()->saveAlbum($album);
		
				// Redirect to list of albums
				return $this->redirect()->toRoute('album');
			}
		}
			
		return array('form' => $alForm);
		
		
	}

	public function editAction(){
	
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('album', array(
					'action' => 'add'
			));
		}
		
		// Get the Album with the specified id.  An exception is thrown
		// if it cannot be found, in which case go to the index page.
		try {
			$album = $this->getAlbumTable()->getAlbum($id);
			
		}
		catch (\Exception $ex) {
			return $this->redirect()->toRoute('album', array(
					'action' => 'index'
			));
		}
		
		$form  = new AlbumForm();
		$catOptions = $this->getAlbumTable()->getCategoryArray();
		$form->setOptionSelect($catOptions);
		$form->initialize();
		$form->bind($album);
		$form->get('submit')->setValue('Update');
		
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setInputFilter($album->getInputFilter());
			$form->setData($request->getPost());
		
			if ($form->isValid()) {
				$this->getAlbumTable()->saveAlbum($album);
		
				// Redirect to list of albums
				return $this->redirect()->toRoute('album');
			}
		}
		
		return array(
				'id' => $id,
				'form' => $form,
		);
	}

	public function deleteAction(){
		
	
		
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('album');
		}
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$del = $request->getPost('del', 'No');
		
			if ($del == 'Yes') {
				$id = (int) $request->getPost('id');
				$this->getAlbumTable()->deleteAlbum($id);
			}
		
			// Redirect to list of albums
			return $this->redirect ()->toRoute ( 'album' );
		}
		
		return array (
				'id' => $id,
				'album' => $this->getAlbumTable ()->getAlbum ( $id ) 
		);
	}
	public function searchAction() {
		
// 		if (! $this->getServiceLocator()
// 		->get('AuthService')->hasIdentity()){
// 			return $this->redirect()->toRoute('login');
// 		}
		
		$request = $this->getRequest();
		if ($request->isPost ()) {
			$kword = $request->getPost ( 'keyword' );
		
			$this->redirect ()->toRoute ( 'searchresult', array (
					'action'=>'searchresult',
					'kword' => $kword,
					
			) );
		} else {
			echo "Bad Http Request";
			exit ();
		}
	}
	
	public function searchresultAction(){
		
// 		if (! $this->getServiceLocator()
// 		->get('AuthService')->hasIdentity()){
// 			return $this->redirect()->toRoute('login');
// 		}
		
		
		$kw =  $this->params()->fromRoute('kword','');


	 	$paginator = $this->getAlbumTable()->selectWhereTitleIs($kw);
	 	
	 	if(null===$paginator){
	 	 return $this->redirect()->toRoute('album');	
	 	 
	 	}
	 	
	 	$paginator->setCurrentPageNumber((int)$this->params()->fromQuery('page', 1));
	 	// set the number of items per page to 10
	 	$paginator->setItemCountPerPage(3);
	 	
	 	return new ViewModel(array(
	 			'paginator' => $paginator,
	 			'kword' =>$kw));
	 	
		
	}
	
	public function getAlbumTable(){
		
		if (! $this->getServiceLocator()
		->get('AuthService')->hasIdentity()){
			return $this->redirect()->toRoute('login');
		}
		
		if (!$this->albumTable) {
			$sm = $this->getServiceLocator();
			$this->albumTable = $sm->get('Album\Model\AlbumTable');
		}
		return $this->albumTable;
	}
}
?>