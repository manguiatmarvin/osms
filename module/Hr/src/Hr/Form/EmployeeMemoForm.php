<?php
namespace Hr\Form;

use Zend\InputFilter;
use Zend\Form\Element;
use Zend\Form\Form;

class EmployeeMemoForm extends Form{
	
	protected  $file_extention;
	
  public function __construct($name = null, $options = array()){
        parent::__construct($name, $options);
        $this->addElements();
        $this->addInputFilter();
  }
  
  public function addElements(){
  	
  	$this->add(array(
  			'name' => 'id',
  			'type' => 'Hidden',
  	));
 
  	
  	//text input
  	$this->add(array(
  			'name' => 'title',
  			'type' => 'Zend\Form\Element\Text',
  			'attributes' => array(
  					'class'  => 'form-control',
  					'cols'=>'30',
  					'rows'=>'3',
  					'placeholder'=>'Enter memo title...',
  			),
  			'options' => array(
  					'label' => 'Title',
  			),
  	));


  	$this->add(array(
  			'name' => 'employee-memo',
  			'type' => 'Zend\Form\Element\File',
  			'attributes' => array(
  					'class'  => 'form-control',
  					'id' => '201-file',
  			),
  			'options' => array(
  					'label' => 'Attach memo file',
  			),
  	));
  	
  	//submit button
  	$this->add(array(
  			'name' => 'submit',
  			'type' => 'Submit',
  			'attributes' => array(
  					'value' => 'Go',
  					'id' => 'uploadeFileSubmitbutton',
  					'class'=>'btn btn-primary edt-profile-btn',
  			),
  	));
  	
  }

  
  
  public function addInputFilter(){
  	$inputFilter = new InputFilter\InputFilter();
  
//   	// File Input
  	$fileInput = new InputFilter\FileInput('employee-memo');
  	$fileInput->setRequired(true);
  	$fileInput->getFilterChain()->attachByName(
  			'filerenameupload',
  			array(
  					'target'    => './data/uploads/',
  					'randomize' => true,
  					'overwrite' => true,
  					'use_upload_name' => true,
  					
  			)
  	);
  	
  	$inputFilter->add($fileInput);
  	
  	
  	$inputFilter->add(array(
					'name'     => 'title',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 150,
									),
							),
					),
			));
  	

  	
  
  	$this->setInputFilter($inputFilter);
  }
  
  public function setUploadFileExtention($xt){
  	$this->file_extention = $xt;
  }
  
  public  function getUploadFileExtention(){
  	 return $this->file_extention;
  }
  
}

?>