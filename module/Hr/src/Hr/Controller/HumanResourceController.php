<?php

namespace HumanResource\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class HumanResourceController extends AbstractActionController {
	
	
	public function indexAction() {
		return new ViewModel();
	
	}
}
?>