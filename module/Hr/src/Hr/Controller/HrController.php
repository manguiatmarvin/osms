<?php

namespace Hr\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Hr\Model\Hr; // <-- Add this import
use Hr\Form\HrForm; // <-- Add this import
use Zend\Form\Form;

class HrController extends AbstractActionController {
	
	protected $hrTable;
	
	public function indexAction() {
		
		if (! $this->getServiceLocator ()->get ( 'AuthService' )->hasIdentity ()) {
			return $this->redirect ()->toRoute ( 'login' );
		}
	}
	
	
	public function employeeAction() {
		
		if (! $this->getServiceLocator ()->get ( 'AuthService' )->hasIdentity ()) {
			return $this->redirect ()->toRoute ( 'login' );
		}
		
				
		// grab the paginator from the AlbumTable
		$paginator = $this->getHrTable()->fetchAll();
		// set the current page to what has been passed in query string, or to 1 if none set
		$paginator->setCurrentPageNumber((int)$this->params()->fromQuery('page', 1));
		// set the number of items per page to 10
		$paginator->setItemCountPerPage(5);
		
		return new ViewModel(array(
				'paginator' => $paginator
		));

	}
	
	
	public function viewEmployeeAction(){
		
		if (! $this->getServiceLocator ()->get ( 'AuthService' )->hasIdentity ()) {
			return $this->redirect ()->toRoute ( 'login' );
		}
		
		$emp_id = (int) $this->params()->fromRoute('id', 0);
		
		if (!$emp_id) {
			return $this->redirect()->toRoute('hr');
		}
		
		try {
			
			$employeeData = $this->getHrTable()->getEmployeePersonal($emp_id);
			$employeeFiles = $this->getHrTable()->getEmployeeFiles($emp_id);
			
		    $empObj = new Hr();
		    $empObj->users_id = $employeeData['users_id'];
		    $empObj->date_hired = $employeeData['date_hired'];
		    $empObj->status =  $employeeData['status'];
		
		}
		catch (\Exception $ex) {
			return $this->redirect()->toRoute('hr', array(
					'action' => 'index'
			));
		}
		
	//	var_dump($employeeAdditionalDetails);
		
		$form  = new HrForm();
		$form->initialize();
		$form->bind($empObj);
     	$form->get('submit')->setValue('Update');

     	$request = $this->getRequest();
     	if ($request->isPost()) {
     		$form->setInputFilter($empObj->getInputFilter());
     		$form->setData($request->getPost());
     	
     		if ($form->isValid()) {
     			 $updateResult = $this->getHrTable()->saveEmployee($empObj);
     			 if((int)$updateResult > 0){
     			 	$name = $employeeData['firstname']."'s ";
     			 	$this->flashMessenger()->addSuccessMessage("{$name} data updated successfully!");
     			 }
     		
     			 return $this->redirect()->toRoute('hr',array('action'=>'employee'));
     		}
     		
     		$this->flashMessenger()->addErrorMessage("Update failed! Please check your inputs");
     	}
     	
		
		return new ViewModel(array('employee_data'=>$employeeData,
				                    'employeeFiles'=>$employeeFiles,
		                             'form'=>$form,'id'=>$employeeData['users_id']));
	}
	
	
	public function preEmploymentAction(){
			return new viewModel();
	}
	
	/**
	 * 
	 * @return Ambigous <object, multitype:>
	 */
	public function getHrTable() {
		if (! $this->hrTable) {
			$sm = $this->getServiceLocator ();
			$this->hrTable = $sm->get ( 'Hr\Model\HrTable' );
		}
		return $this->hrTable;
	}
}
?>