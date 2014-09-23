<?php

namespace Hr\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Hr\Model\Hr; // <-- Add this import
use Hr\Form\HrForm; // <-- Add this import
use Hr\Form\EmployeeMemoForm;
use Zend\Form\Form;
use Hr\Model\EmployeeFile;
use Zend\InputFilter;
use MarvinFileUploadUtils\FileUploadUtils;

class HrController extends AbstractActionController {
	
	protected $hrTable;
	protected $eFilesTable;
	protected $eMemoTable;
	
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
		                             'viewEmployeeForm'=>$form,
				                     'id'=>$employeeData['users_id']));
	}
	
	
	public function preEmploymentAction(){
			return new viewModel();
	}
	
	public function employeeMemoAction(){
				$this->checkLogin ();
		
		$emp_id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
		
		if (! $emp_id) {
			return $this->redirect ()->toRoute ( 'hr' );
		}
		
		$employeeData = $this->getHrTable ()->getEmployeePersonal ( $emp_id );
		$employeeMemos = $this->getEmployeeMemoTable()->getEmployeeMemo($emp_id);
		
		$form = new EmployeeMemoForm();
		$form->get ( 'submit' )->setValue ( 'Add Memo' );
		
		return new ViewModel ( array (
				'empMemos' => $employeeMemos,
				'employeeData' => $employeeData,
				'addMemoForm' => $form,
				'id' => $employeeData ['users_id'] 
		) );
	}
	
	public function addEmployeeMemo(){
		$this->checkLogin ();
		
		$emp_id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
		
		if (! $emp_id) {
			return $this->redirect ()->toRoute ( 'hr' );
		}
		
		return new ViewModel();
	}
		
		/*
	 * 201 files
	 */
	public function employeeFilesAction() {
		$this->checkLogin ();
		
		$emp_id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
		
		if (! $emp_id) {
			return $this->redirect ()->toRoute ( 'hr' );
		}
		
		$employeeData = $this->getHrTable ()->getEmployeePersonal ( $emp_id );
		$employeeFiles = $this->getEmployeeFileTable ()->getEmployeeFiles ( $emp_id );
		
		$form = new EmployeeFileUploadForm ();
		$form->get ( 'submit' )->setValue ( 'Add' );
		
		return new ViewModel ( array (
				'empFiles' => $employeeFiles,
				'employeeData' => $employeeData,
				'addFileForm' => $form,
				'id' => $employeeData ['users_id'] 
		) );
	}
	
	/**
	 * delete single 201 file
	 * TODO: check if file id belongs to emp_id otherwise this is a hacking attemp
	 * and this must be logged  
	 * @return Ambigous <\Zend\Http\Response, \Zend\Stdlib\ResponseInterface>
	 */
	public function deleteEmployeeFileAction() {
		$this->checkLogin ();
		
		$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
		$emp_id = ( int ) $this->params ()->fromRoute ( 'emp_id', 0 );
		
		if (! $emp_id) {
			return $this->redirect ()->toRoute ( 'hr' );
		}
		
		$this->getEmployeeFileTable ()->deleteEmployeeFile ( $emp_id, $id );
		
		return $this->redirect ()->toRoute ( 'hr', array (
				'action' => 'employee-files',
				'id' => $emp_id 
		) );
	}
	
	/**
	 * force download a file from 201 records
	 * @return Ambigous <\Zend\Http\Response, \Zend\Stdlib\ResponseInterface>|\Zend\Stdlib\ResponseInterface
	 */
	public function downloadEmployeeFileAction(){
		$this->checkLogin();
		
		$id = (int) $this->params()->fromRoute('id', 0);
		$emp_id = (int) $this->params()->fromRoute('emp_id', 0);
		if(!$id && !$emp_id){
			return $this->redirect()->toRoute('hr');
		}
		try {
			
			$employeeFiles = $this->getEmployeeFileTable()->getSingleEmployeeFile($emp_id,$id);
			 
		}
		catch (\Exception $ex) {
			$this->flashMessenger()->addErrorMessage("Fatal Error! File ".addslashes($ex));
			return $this->redirect()->toRoute('hr', array(
					'action' => 'employee'
			));
		}
		
		$fileName = ROOT_PATH.'/data/employee_files/'.$emp_id.'/'.$employeeFiles->filename;
		
		if(!file_exists($fileName)){
			$this->flashMessenger()->addErrorMessage("Fatal Error! File ".$employeeFiles->filename." canot found on server");
		 	return $this->redirect()->toRoute('hr',array('action'=>'employee-files','id'=>$emp_id));
		    exit;
		}
		
		//download process start
		$fileUtils = new FileUploadUtils($fileName);
		$response = $this->getResponse();
		$headers = $response->getHeaders();
		$headers->clearHeaders()
		->addHeaderLine('Content-type: ' . $fileUtils->file_src_mime)
		->addHeaderLine("Content-Disposition: attachment; filename=".rawurlencode($fileUtils->file_src_name).";");
		$fileUtils->process();
		
		return $this->response;
	}
	
	
	/**
	 * add 201 files
	 */
	public function addEmployeeFileAction(){
			$this->checkLogin();
		
		$emp_id = (int) $this->params()->fromRoute('id', 0);
		
		if(!$emp_id){
			$this->flashMessenger()->addErrorMessage("Invalid User Id ");
				return $this->redirect()->toRoute('hr', array(
					'action' => 'employee'
			));
		}
		
		$form = new EmployeeFileUploadForm();
		
		$form->get('submit')->setValue('Add');
		$tempFile = null;
		
		$prg = $this->fileprg($form);
		
		
		if ($prg instanceof \Zend\Http\PhpEnvironment\Response) {
			return $prg; // Return PRG redirect response
		} elseif (is_array($prg)) {
			
			$eFile = new EmployeeFile();
			if ($form->isValid()) {
				$data = $form->getData();
				$eFile->exchangeArray($data);
				
				//process file
				$fileToCopy = $data["employee-file"]["tmp_name"];
				
				//get original extention
				$unique = uniqid();
				$handle = explode('.', $data["employee-file"]["name"]);
				$extension = end($handle);
				$filenameBody = "userfile".$emp_id."_".$data["file_type_id"].'_'.$unique;
			    $fileDestn = ROOT_PATH.'/data/employee_files/'.$emp_id.'/'.$filenameBody.'.'.$extension;
	
			    mkdir(dirname($fileDestn), 0777, true);
			    @copy($fileToCopy,$fileDestn);
			    
			    $eFile->filename = $filenameBody.'.'.$extension;
			    $eFile->employee_id = $emp_id;
		        $this->getEmployeeFileTable()->saveEmpoyeeFile($eFile);
		        
		       	return $this->redirect()->toRoute('hr', array(
					'action' => 'employee-files',
		       			'id'=>$emp_id
			    ));
			    
			} else {
				// Form not valid, but file uploads might be valid...
				// Get the temporary file information to show the user in the view
				$fileErrors = $form->get('employee-file')->getMessages();
				if (empty($fileErrors)) {
					$tempFile = $form->get('employee-file')->getValue();
				}
				
			
			}
		}
			
		
		return array (
				'form' => $form,
				'emp_id'=>$emp_id
		);
	
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
	
	public function getEmployeeMemoTable(){
	
		if (!$this->eMemoTable) {
			$sm = $this->getServiceLocator();
			if($sm->has('Hr\Model\EmployeeMemoTable')){
				$this->eMemoTable = $sm->get('Hr\Model\EmployeeMemoTable');
			}
		}
	
		return $this->eMemoTable;
	}
	
}
?>