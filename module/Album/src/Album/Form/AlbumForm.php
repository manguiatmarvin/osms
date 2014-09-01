<?php
namespace Album\Form;

use Zend\Form\Form;
use Zend\Db\Adapter\AdapterInterface;

class AlbumForm extends Form{
	protected $optionSelect;
	
	public function __construct()
	{
		
		// we want to ignore the name passed
		parent::__construct('album');

	}
	
	public function initialize(){
		
		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden',
		));
		$this->add(array(
				'name' => 'title',
				'type' => 'Text',
				'options' => array(
						'label' => 'Title',
				),
		));
		$this->add(array(
				'name' => 'artist',
				'type' => 'Text',
				'options' => array(
						'label' => 'Artist',
				),
		));
		
		
		
		$this->add(array(
				'name'    => 'category_id',
				'type'    => 'Zend\Form\Element\Select',
				'options' => array(
						'label'         => 'category',
						'value_options' => $this->getOptionSelect(),
						'empty_option'  => '--- please choose ---'
				)
		));
		
		
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Go',
						'id' => 'submitbutton',
				),
		));
		
	}
	
	//setter and getter for options 
	
	public function setOptionSelect($options){
		$this->optionSelect = $options;
	}
	
	public function getOptionSelect(){
		return $this->optionSelect;
	}
}