<?php

namespace Profile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Profile\Model\Profile;          // <-- Add this import
use Profile\Form\ProfileForm; // <-- Add this import

class ProfileController extends AbstractActionController {
	protected $profileTable;
	protected $usersId;
	
	public function indexAction() {
		if (! $this->getServiceLocator()
				->get('AuthService')->hasIdentity()){
					return $this->redirect()->toRoute('login');
				}else{
			
			$identity = $this->getServiceLocator()->get('AuthService')->getIdentity()['user_name'];
			
		}
				
	 $profile = $this->getProfileTable ()->getProfileInfoByUserName($identity);
		
		return new ViewModel(array(
			'profile'=>$profile
		));
	
	}
	
	public function viewAction(){
		$identity = null;
		
	   if (! $this->getServiceLocator()
		->get('AuthService')->hasIdentity()){
	   	    
			return $this->redirect()->toRoute('login');
		}else{
			
			$identity = $this->getServiceLocator()->get('AuthService')->getIdentity()['user_name'];
			
		}

		try {
				$profile = $this->getProfileTable ()->getProfileInfoByUserName($identity);
				
		}
		catch (\Exception $ex) {
			return $this->redirect()->toRoute('home', array(
					'action' => 'index'
			));
		}
		
		return new ViewModel(array(
				'profile' => $profile,
		)); 
	}
	
	public function editAction(){
				$identity = null;
		
	   if (! $this->getServiceLocator()
		->get('AuthService')->hasIdentity()){
	   	    
			return $this->redirect()->toRoute('login');
		}else{
			
			$identity = $this->getServiceLocator()->get('AuthService')->getIdentity()['user_name'];
		
			
		}

		try {
				$profile = $this->getProfileTable ()->getProfileInfoByUserName($identity);
				$id = $profile['users_id'];
				$profile2 = $this->getProfileTable ()->getProfileById($id);
		} 
		catch (\Exception $ex) {
			return $this->redirect()->toRoute('home', array(
					'action' => 'index'
			));
		}
		
		
		$form  = new ProfileForm();
		$form->setGenderOptionSelect($this->getProfileTable ()->getGenderArray());
		$form->initialize();
		$form->bind($profile2);
		$form->get('submit')->setValue('Update');
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setInputFilter($profile2->getInputFilter());
			$form->setData($request->getPost());
		
			if ($form->isValid()) {
				
				$this->getProfileTable()->saveProfile($profile2);
		
				// Redirect to list of albums
				return $this->redirect()->toRoute('profile',array('action'=>'view'));
			}
		}
		
		return array(
				'form' => $form,
		);
		
	}
	
	public function settingsAction() {
		
		if (! $this->getServiceLocator()
		->get('AuthService')->hasIdentity()){
				
			return $this->redirect()->toRoute('login');
		}
		
		return new ViewModel();
	
	}
	
	
	public function changePasswordAction() {
		
		if (! $this->getServiceLocator()
		->get('AuthService')->hasIdentity()){
				
			return $this->redirect()->toRoute('login');
		}
		
		return new ViewModel();
	
	}
	
	

	
	public function getProfileTable(){
	
// 		if (! $this->getServiceLocator()
// 		->get('AuthService')->hasIdentity()){
// 			return $this->redirect()->toRoute('login');
// 		}
	
		if (!$this->profileTable) {
			$sm = $this->getServiceLocator();
			$this->profileTable = $sm->get('Profile\Model\ProfileTable');
		}
		return $this->profileTable;
	}
	
}
?>