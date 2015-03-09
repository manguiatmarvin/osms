<?php
namespace Client\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Form;
use MarvinFileUploadUtils\FileUploadUtils;
use Zend\View\View;
use Hr\Model\Hr; 

class ClientController extends AbstractActionController {
	protected $clientTable;
	protected $clientId;
	protected $mystaffTable;
	public function indexAction() {
		
		}
		
		
		public function myTeamAction(){
			$this->checkLogin();
			
			$loginDetails = $this->getServiceLocator ()->get ( 'AuthService' )->getIdentity();
			
			

			// grab the paginator from the AlbumTable
			$paginator = $this->getHrTable()->fetchAll();
			// set the current page to what has been passed in query string, or to 1 if none set
			$paginator->setCurrentPageNumber($this->params()->fromRoute('page', 0));
			// set the number of items per page to 10
			$paginator->setItemCountPerPage(5);
			
			return new ViewModel(array(
					'paginator' => $paginator
			));
			
		}
		
		
		public function clientProjectsAction(){
			return new ViewModel();
		}
		
		

		private function checkLogin(){
			if (! $this->getServiceLocator ()->get ( 'AuthService' )->hasIdentity ()) {
				return $this->redirect ()->toRoute ( 'login' );
				exit;
			}
		}

		public function getHrTable() {
			if (! $this->mystaffTable) {
				$sm = $this->getServiceLocator ();
				$this->mystaffTable = $sm->get('Hr\Model\HrTable' );
			}
			return $this->mystaffTable;
		}

}
?>