<?php

namespace Hr\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Hr\Model\Hr; // <-- Add this import
use Hr\Form\HrForm; // <-- Add this import
use Zend\Form\Form;
use Hr\Model\EmployeeFile;

class HrController extends AbstractActionController {
	
	protected $hrTable;
	protected $eFilesTable;
	
	public function indexAction() {
		
		$this->checkLogin();
	}
	
	public function employeeAction() {
		
	$this->checkLogin();
				
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
		
          $this->checkLogin();
		
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
		                             'form'=>$form,
				                     'id'=>$employeeData['users_id']));
	}
	
	
	public function preEmploymentAction(){
			return new viewModel();
	}
	
	public function employeeMemoAction(){
		$emp_id = (int) $this->params()->fromRoute('id', 0);
		$employeeData = $this->getHrTable()->getEmployeePersonal($emp_id);
		$employeeFiles = $this->getHrTable()->getEmployeeFiles($emp_id);
		
		return new viewModel(array('files'=>$employeeFiles));
	}
	
	/*
	 * 
	 * 201 files 
	 */
	public function employeeFilesAction(){
				
		$this->checkLogin();
		
		$emp_id = (int) $this->params()->fromRoute('id', 0);
		
		
		if (!$emp_id) {
			return $this->redirect()->toRoute('hr');
		}
		
		try {
			$employeeData = $this->getHrTable()->getEmployeePersonal($emp_id);
		    $employeeFiles = $this->getEmployeeFileTable()->getEmployeeFiles($emp_id);
		   
		}
		catch (\Exception $ex) {
			
			return $this->redirect()->toRoute('hr', array(
					'action' => 'employee'
			));
		}
		
		
		return new ViewModel(array('empFiles'=>$employeeFiles,'employeeData'=>$employeeData));
	}
	
	
	
	private function checkLogin(){
		if (! $this->getServiceLocator ()->get ( 'AuthService' )->hasIdentity ()) {
			return $this->redirect ()->toRoute ( 'login' );
			exit;
		}
	}
	
	
	
	//services!!!!!!!
	/**
	 * 
	 * @return Ambigous <object, multitype:>
	 */
	public function getHrTable() {
		if (! $this->hrTable) {
			$sm = $this->getServiceLocator ();
			$this->hrTable = $sm->get('Hr\Model\HrTable' );
		}
		return $this->hrTable;
	}
	
	
	public function getEmployeeFileTable(){
	
		if (!$this->eFilesTable) {
			$sm = $this->getServiceLocator();
			if($sm->has('Hr\Model\EmployeeFileTable')){
				$this->eFilesTable = $sm->get('Hr\Model\EmployeeFileTable');
			}
		}
		
		return $this->eFilesTable;
	}
}
?>