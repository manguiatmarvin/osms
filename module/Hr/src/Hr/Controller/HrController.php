<?php

namespace Hr\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Hr\Model\Hr; // <-- Add this import
use Hr\Form\HrForm; // <-- Add this import
use Hr\Form\EmployeeFileUploadForm;
use Zend\Form\Form;
use Hr\Model\EmployeeFile;
use Zend\InputFilter;

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
		                             'viewEmployeeForm'=>$form,
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
		
	
			$employeeData = $this->getHrTable()->getEmployeePersonal($emp_id);
		    $employeeFiles = $this->getEmployeeFileTable()->getEmployeeFiles($emp_id);
		    
		    $form = new EmployeeFileUploadForm();
		    $form->get('submit')->setValue('Add');
	
		
		
		return new ViewModel(array('empFiles'=>$employeeFiles,
				                   'employeeData'=>$employeeData,
		                           'addFileForm'=>$form,
		                           'id'=>$employeeData['users_id']));
	}
	
	
	public function deleteEmployeeFileAction(){
		$this->checkLogin();
		
		$id = (int) $this->params()->fromRoute('id', 0);
		$emp_id = (int) $this->params()->fromRoute('emp_id', 0);
		
		
		if (!$emp_id) {
			return $this->redirect()->toRoute('hr');
		}
		
		$this->getEmployeeFileTable()->deleteEmployeeFile($emp_id,$id);
		
		return $this->redirect()->toRoute('hr', array(
				'action' => 'employee-files',
				'id' => $emp_id
		));
	}
	
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
		
		$fileContents = file_get_contents($fileName);
		$mime_type   = $this->getMimeType($fileName);
		
		$response = $this->getResponse();
		$response->setContent($fileContents);
		
		$headers = $response->getHeaders();
		$headers->clearHeaders()
		->addHeaderLine('Content-Type',$mime_type)
		->addHeaderLine('Content-Disposition', 'attachment; filename="' . $fileName . '"')
		->addHeaderLine('Content-Length', strlen($fileContents));
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
				$handle = explode('.', $data["employee-file"]["name"]);
				$extension = end($handle);
				$filenameBody = "userfile".$emp_id."_".$data["file_type_id"];
			    $fileDestn = ROOT_PATH.'/data/employee_files/'.$emp_id.'/'.$filenameBody.'.'.$extension;
	
			    mkdir(dirname($fileDestn), 0777, true);
			    copy($fileToCopy,$fileDestn);
			    
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

	
	private function getMimeType($file) {
		// MIME types array
		$mimeTypes = array(
				"323"       => "text/h323",
				"acx"       => "application/internet-property-stream",
				"ai"        => "application/postscript",
				"aif"       => "audio/x-aiff",
				"aifc"      => "audio/x-aiff",
				"aiff"      => "audio/x-aiff",
				"asf"       => "video/x-ms-asf",
				"asr"       => "video/x-ms-asf",
				"asx"       => "video/x-ms-asf",
				"au"        => "audio/basic",
				"avi"       => "video/x-msvideo",
				"axs"       => "application/olescript",
				"bas"       => "text/plain",
				"bcpio"     => "application/x-bcpio",
				"bin"       => "application/octet-stream",
				"bmp"       => "image/bmp",
				"c"         => "text/plain",
				"cat"       => "application/vnd.ms-pkiseccat",
				"cdf"       => "application/x-cdf",
				"cer"       => "application/x-x509-ca-cert",
				"class"     => "application/octet-stream",
				"clp"       => "application/x-msclip",
				"cmx"       => "image/x-cmx",
				"cod"       => "image/cis-cod",
				"cpio"      => "application/x-cpio",
				"crd"       => "application/x-mscardfile",
				"crl"       => "application/pkix-crl",
				"crt"       => "application/x-x509-ca-cert",
				"csh"       => "application/x-csh",
				"css"       => "text/css",
				"dcr"       => "application/x-director",
				"der"       => "application/x-x509-ca-cert",
				"dir"       => "application/x-director",
				"dll"       => "application/x-msdownload",
				"dms"       => "application/octet-stream",
				"doc"       => "application/msword",
				"docx"       => "application/msword",
				"dot"       => "application/msword",
				"dvi"       => "application/x-dvi",
				"dxr"       => "application/x-director",
				"eps"       => "application/postscript",
				"etx"       => "text/x-setext",
				"evy"       => "application/envoy",
				"exe"       => "application/octet-stream",
				"fif"       => "application/fractals",
				"flr"       => "x-world/x-vrml",
				"gif"       => "image/gif",
				"gtar"      => "application/x-gtar",
				"gz"        => "application/x-gzip",
				"h"         => "text/plain",
				"hdf"       => "application/x-hdf",
				"hlp"       => "application/winhlp",
				"hqx"       => "application/mac-binhex40",
				"hta"       => "application/hta",
				"htc"       => "text/x-component",
				"htm"       => "text/html",
				"html"      => "text/html",
				"htt"       => "text/webviewhtml",
				"ico"       => "image/x-icon",
				"ief"       => "image/ief",
				"iii"       => "application/x-iphone",
				"ins"       => "application/x-internet-signup",
				"isp"       => "application/x-internet-signup",
				"jfif"      => "image/pipeg",
				"jpe"       => "image/jpeg",
				"jpeg"      => "image/jpeg",
				"jpg"       => "image/jpeg",
				"js"        => "application/x-javascript",
				"latex"     => "application/x-latex",
				"lha"       => "application/octet-stream",
				"lsf"       => "video/x-la-asf",
				"lsx"       => "video/x-la-asf",
				"lzh"       => "application/octet-stream",
				"m13"       => "application/x-msmediaview",
				"m14"       => "application/x-msmediaview",
				"m3u"       => "audio/x-mpegurl",
				"man"       => "application/x-troff-man",
				"mdb"       => "application/x-msaccess",
				"me"        => "application/x-troff-me",
				"mht"       => "message/rfc822",
				"mhtml"     => "message/rfc822",
				"mid"       => "audio/mid",
				"mny"       => "application/x-msmoney",
				"mov"       => "video/quicktime",
				"movie"     => "video/x-sgi-movie",
				"mp2"       => "video/mpeg",
				"mp3"       => "audio/mpeg",
				"mpa"       => "video/mpeg",
				"mpe"       => "video/mpeg",
				"mpeg"      => "video/mpeg",
				"mpg"       => "video/mpeg",
				"mpp"       => "application/vnd.ms-project",
				"mpv2"      => "video/mpeg",
				"ms"        => "application/x-troff-ms",
				"mvb"       => "application/x-msmediaview",
				"nws"       => "message/rfc822",
				"oda"       => "application/oda",
				"p10"       => "application/pkcs10",
				"p12"       => "application/x-pkcs12",
				"p7b"       => "application/x-pkcs7-certificates",
				"p7c"       => "application/x-pkcs7-mime",
				"p7m"       => "application/x-pkcs7-mime",
				"p7r"       => "application/x-pkcs7-certreqresp",
				"p7s"       => "application/x-pkcs7-signature",
				"pbm"       => "image/x-portable-bitmap",
				"pdf"       => "application/pdf",
				"pfx"       => "application/x-pkcs12",
				"pgm"       => "image/x-portable-graymap",
				"pko"       => "application/ynd.ms-pkipko",
				"pma"       => "application/x-perfmon",
				"pmc"       => "application/x-perfmon",
				"pml"       => "application/x-perfmon",
				"pmr"       => "application/x-perfmon",
				"pmw"       => "application/x-perfmon",
				"pnm"       => "image/x-portable-anymap",
				"pot"       => "application/vnd.ms-powerpoint",
				"ppm"       => "image/x-portable-pixmap",
				"pps"       => "application/vnd.ms-powerpoint",
				"ppt"       => "application/vnd.ms-powerpoint",
				"prf"       => "application/pics-rules",
				"ps"        => "application/postscript",
				"pub"       => "application/x-mspublisher",
				"qt"        => "video/quicktime",
				"ra"        => "audio/x-pn-realaudio",
				"ram"       => "audio/x-pn-realaudio",
				"ras"       => "image/x-cmu-raster",
				"rgb"       => "image/x-rgb",
				"rmi"       => "audio/mid",
				"roff"      => "application/x-troff",
				"rtf"       => "application/rtf",
				"rtx"       => "text/richtext",
				"scd"       => "application/x-msschedule",
				"sct"       => "text/scriptlet",
				"setpay"    => "application/set-payment-initiation",
				"setreg"    => "application/set-registration-initiation",
				"sh"        => "application/x-sh",
				"shar"      => "application/x-shar",
				"sit"       => "application/x-stuffit",
				"snd"       => "audio/basic",
				"spc"       => "application/x-pkcs7-certificates",
				"spl"       => "application/futuresplash",
				"src"       => "application/x-wais-source",
				"sst"       => "application/vnd.ms-pkicertstore",
				"stl"       => "application/vnd.ms-pkistl",
				"stm"       => "text/html",
				"svg"       => "image/svg+xml",
				"sv4cpio"   => "application/x-sv4cpio",
				"sv4crc"    => "application/x-sv4crc",
				"t"         => "application/x-troff",
				"tar"       => "application/x-tar",
				"tcl"       => "application/x-tcl",
				"tex"       => "application/x-tex",
				"texi"      => "application/x-texinfo",
				"texinfo"   => "application/x-texinfo",
				"tgz"       => "application/x-compressed",
				"tif"       => "image/tiff",
				"tiff"      => "image/tiff",
				"tr"        => "application/x-troff",
				"trm"       => "application/x-msterminal",
				"tsv"       => "text/tab-separated-values",
				"txt"       => "text/plain",
				"uls"       => "text/iuls",
				"ustar"     => "application/x-ustar",
				"vcf"       => "text/x-vcard",
				"vrml"      => "x-world/x-vrml",
				"wav"       => "audio/x-wav",
				"wcm"       => "application/vnd.ms-works",
				"wdb"       => "application/vnd.ms-works",
				"wks"       => "application/vnd.ms-works",
				"wmf"       => "application/x-msmetafile",
				"wps"       => "application/vnd.ms-works",
				"wri"       => "application/x-mswrite",
				"wrl"       => "x-world/x-vrml",
				"wrz"       => "x-world/x-vrml",
				"xaf"       => "x-world/x-vrml",
				"xbm"       => "image/x-xbitmap",
				"xla"       => "application/vnd.ms-excel",
				"xlc"       => "application/vnd.ms-excel",
				"xlm"       => "application/vnd.ms-excel",
				"xls"       => "application/vnd.ms-excel",
				"xlsx"      => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
				"xltx"      => "application/vnd.openxmlformats-officedocument.spreadsheetml.template",
				"pptx"      => "application/vnd.openxmlformats-officedocument.presentationml.presentation",
				"ppsx"      => "application/vnd.openxmlformats-officedocument.presentationml.slideshow",
				"xlt"       => "application/vnd.ms-excel",
				"xlw"       => "application/vnd.ms-excel",
				"xof"       => "x-world/x-vrml",
				"xpm"       => "image/x-xpixmap",
				"xwd"       => "image/x-xwindowdump",
				"z"         => "application/x-compress",
				"zip"       => "application/zip",
				"png"      => "image/png",
				"jpg"      => "image/jpg",
				"jpeg"      => "image/jpeg",
				"gif"      => "image/gif"
						);
	
		$handle = explode('.', $file);
		$extension = end($handle);
		return $mimeTypes[$extension]; // return the array value
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