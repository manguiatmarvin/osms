<?php
namespace Hr\Form;

use Zend\InputFilter;
use Zend\Form\Element;
use Zend\Form\Form;

class EmployeeFileUploadForm extends Form{
	
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
  	
  	$this->add(array(
  			'name' => 'employee-file',
  			'type' => 'Zend\Form\Element\File',
  			'attributes' => array(
  					'class'  => 'form-control',
  					'id' => '201-file',
  			),
  			'options' => array(
  					'label' => 'Upload 201 File',
  			),
  	));
  	
  	
  	$this->add(array(
  			'name' => 'file_type_id',
  			'type' => 'Zend\Form\Element\Select',
  			'attributes' => array(
  					'class'  => 'form-control',
  			),
  			'options' => array(
  					'label'         => 'Type',
  					'value_options' => array('1'=>'Picture',
  							                 '2'=>'Resume',
  					                         '3'=>'Job Offer',
  					                         '4'=>'Contract'),
  					'empty_option'  => '--- please choose ---'
  			)
  	));
  	
  	//text input 
  	$this->add(array(
  			'name' => 'description',
  			'type' => 'Zend\Form\Element\Textarea',
  			'attributes' => array(
  					'class'  => 'form-control',
  					'cols'=>'30',
  					'rows'=>'3',
  					'placeholder'=>'Enter description of file...',
  			),
  			'options' => array(
  					'label' => 'Description',
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
  	$fileInput = new InputFilter\FileInput('employee-file');
  	$fileInput->setRequired(true);
  	$fileInput->getFilterChain()->attachByName(
  			'filerenameupload',
  			array(
  					'target'    => './data/uploads/201files.data',
  					'randomize' => true,
  			)
  	);
  	
  	$inputFilter->add($fileInput);
  	
  	
  	$inputFilter->add(array(
					'name'     => 'description',
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
  	
  	$inputFilter->add(array(
  			'name'     => 'description',
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
  	
  	
  	$inputFilter->add(array(
					'name'     => 'file_type_id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
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