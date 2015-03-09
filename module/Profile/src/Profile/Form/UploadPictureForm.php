<?php 
namespace Profile\Form;

use Zend\InputFilter;
use Zend\Form\Element;
use Zend\Form\Form;

class UploadPictureForm extends Form{
	
 public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->addElements();
        $this->addInputFilter();
        $this->setAttribute('enctype','multipart/form-data');
    }
	
	public function addElements()
	{
		 // File Input
        $file = new Element\File('image-file');
        $file->setLabel('Avatar Image Upload')
             ->setAttribute('id', 'image-file');
        $this->add($file);
	}
	
	public function addInputFilter()
	{
		$inputFilter = new InputFilter\InputFilter();

        // File Input
        $fileInput = new InputFilter\FileInput('image-file');
        $fileInput->setRequired(true);
        $fileInput->getFilterChain()->attachByName(
            'filerenameupload',
            array(
                   'target'    => ROOT_PATH.'/data/uploads/image.png',
                'randomize' => true,
            )
        );
        
        $inputFilter->add($fileInput);

        $this->setInputFilter($inputFilter);
	}
	
	
}
?>