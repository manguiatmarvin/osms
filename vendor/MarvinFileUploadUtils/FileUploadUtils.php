<?php 
/**
 * Upload file Utility class for common 
 * File or image  manipulation tools 
 * @author marvin
 * 
 * Sept 9, 2014
 * Sourcefit Philippines Inc.
 */
namespace MarvinFileUploadUtils;

use MarvinFileUploadUtils\UploadClass\Upload;

class FileUploadUtils extends Upload {
	
	public $xfile;
	protected $max_file_size = 2097152; // 2 mb max
	
	public function FileUploadUtils($file) {
		$this->xfile = $file;
		parent::__construct( $this->xfile );
	}
	
	public  function file_is_image(){
		return $this->file_is_image;
	}
	
	public function getProcessedFile(){
		return $this->file_dst_name;
	}
	
	public function clear(){
		parent::clean();
	}
	
	public function getMemiType(){
		return $this->file_src_mime;
	}
	
	/**
	 * determine the target file exceeds file limits (2097152) 2 mb
	 * @return boolean
	 */
	public function isFileTooBig(){
		return ($this->file_src_size > $this->max_file_size);
	}
	
	public function sayHello(){
		return "Hello from FileUploadUtils Class!";
	}
	
}
?>