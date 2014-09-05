<?php
namespace Profile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Profile\Model\Profile;          // <-- Add this import
use Profile\Form\ProfileForm; // <-- Add this import
use Profile\Form\ChangePasswordForm;
use Zend\Form\Form;


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
				$profile = $this->getProfileTable()->getProfileInfoByUserName($identity);
				
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
	
	
	/**
	 * settings Module
	 * @return Ambigous <\Zend\Http\Response, \Zend\Stdlib\ResponseInterface>|\Zend\View\Model\ViewModel
	 */
	public function settingsAction() {
		
		if (! $this->getServiceLocator ()->get ( 'AuthService' )->hasIdentity ()) {
			
			return $this->redirect ()->toRoute ( 'login' );
		}
		
		return new ViewModel ();
	}
	
	public function accountSettingsAction() {
	
		if (! $this->getServiceLocator ()->get ( 'AuthService' )->hasIdentity ()) {
				
			return $this->redirect ()->toRoute ( 'login' );
		}
	
		return new ViewModel ();
	}
	
	
	/**
	 * password change module
	 * @return Ambigous <\Zend\Http\Response, \Zend\Stdlib\ResponseInterface>|\Zend\View\Model\ViewModel
	 */
	public function changePasswordAction() {
		if (! $this->getServiceLocator ()->get ( 'AuthService' )->hasIdentity ()) {
			
			return $this->redirect ()->toRoute('login');
		}else{
			
				$userDetails = $this->getServiceLocator()->get('AuthService')->getIdentity();
			
			}
		
			$passwordDetails = $this->getProfileTable ()->getPasswordDetails($userDetails['users_id']);
		
			$request = $this->getRequest();
			if ($request->isPost()) {
				
				//get Post value
				$currentPassword = $request->getPost('oldpassword');
				$desirePassword = $request->getPost('newpassword1');
				$desirePasswordRe = $request->getPost('newpassword2');
			    // check for empty
			    if(empty($currentPassword) || 
			       empty($desirePassword) || 
			       empty($desirePasswordRe)){
			    	$this->flashMessenger()->addErrorMessage("Please fill the required fields before submitting the form");
			    }else if($desirePassword !== $desirePasswordRe){
					$this->flashMessenger()->addErrorMessage("Entered \"Password\" does not matched");
				}else if($currentPassword !== $passwordDetails->oldPassword){
					$this->flashMessenger()->addErrorMessage("Entered \"Current Password\" does not matched from your original password");
				}else if(strlen($desirePassword) > 100){
					$this->flashMessenger()->addErrorMessage("Entered \"New Password\" invalid character count, acceptable 100");
				}else{
					//finalized and save
					$updatePasswordRes = $this->getProfileTable()->updatePassword($userDetails['user_name'],$passwordDetails->oldPassword,$desirePassword);
					
					if($updatePasswordRes){
						$this->flashMessenger()->addSuccessMessage("Password updated successfully");
					}else{
						$this->flashMessenger()->addErrorMessage("OOps! There was a problem updating your password. Please contact the admin");
					}
								
					
				}
				
				return $this->redirect()->toRoute('profile',array('action'=>'change-password'));
			}
			
	       return array('messages'=>$this->flashMessenger()->getMessages());
	       
	}
	
	public function editAction(){
		$identity = null;
	
		if (! $this->getServiceLocator()
		->get('AuthService')->hasIdentity()){
				
			return $this->redirect()->toRoute('login');
		}else{
				
			$user_id = $this->getServiceLocator()->get('AuthService')->getIdentity()['users_id'];
				
		}
	
		try {
// 			$profile = $this->getProfileTable ()->getProfileInfoByUserName($identity);
// 			$id = $profile['users_id'];
			$profile = $this->getProfileTable ()->getProfileById($user_id);
		}
		catch (\Exception $ex) {
			return $this->redirect()->toRoute('home', array(
					'action' => 'index'
			));
		}
	
		$form  = new ProfileForm();
		$form->setGenderOptionSelect($this->getProfileTable ()->getGenderArray());
		$form->initialize();
		$form->bind($profile);
		$form->get('submit')->setValue('Update');
	
		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setInputFilter($profile->getInputFilter());
			$form->setData($request->getPost());
	
			if ($form->isValid()) {
	
				$this->getProfileTable()->saveProfile($profile);
	            //set flashmessage
	            $this->flashMessenger()->addSuccessMessage("Profile updated successfully");
				// Redirect to profile
				return $this->redirect()->toRoute('profile',array('action'=>'view'));
			}
		}
	
		return array(
				'form' => $form,
		);
	
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