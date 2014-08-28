<?php

namespace Profile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProfileController extends AbstractActionController {
	
	
	public function indexAction() {
		return new ViewModel();
	
	}
}
?>