<?php
namespace Profile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Profile\Model\Profile;          // <-- Add this import
use Profile\Form\ProfileForm; // <-- Add this import
use Profile\Form\ChangePasswordForm;
use Zend\Form\Form;
use Profile\Form\UploadPictureForm;
use MarvinFileUploadUtils\FileUploadUtils;

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
					// set flashmessage
				$this->flashMessenger ()->addSuccessMessage ( "Profile updated successfully" );
				// Redirect to profile
				return $this->redirect ()->toRoute ( 'profile', array (
						'action' => 'view' 
				) );
			}
		}
		
		return array (
				'form' => $form 
		);
	}
	
	/**
	 * 
	 * @return multitype:unknown \Profile\Form\UploadPictureForm
	 */
	public function uploadProfilePictureAction() {
		$form = new UploadPictureForm ( 'upload-profile-picture' );
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			//get currently logged profiledata
			$profileData        =  $this->getServiceLocator()->get('AuthService')->getIdentity();
			
			// Make certain to merge the files info!
			$post = array_merge_recursive($request->getPost ()->toArray (), 
					                        $request->getFiles ()->toArray () );
			
			$form->setData ( $post );
			if ($form->isValid()) {
				
            $data = $form->getData();
            $file = $data["image-file"]["tmp_name"];
            $uploadUtils = new FileUploadUtils($file);
            
            //check if image
            if(!$uploadUtils->file_is_image()){
            	unset($file);
            	$this->flashMessenger ()->addSuccessMessage ( "Please upload image file only ");
            	return $this->redirect()->toRoute('profile',array('action'=>'upload-profile-picture'));
            }
            //check file size
            if($uploadUtils->isFileTooBig()){
            	unset($file);
            	$this->flashMessenger ()->addSuccessMessage ( "Please upload image file not larger that 2 mb");
            	return $this->redirect()->toRoute('profile',array('action'=>'upload-profile-picture'));
            }
            
            //process file  make it 150px in width            
            $uploadUtils->file_new_name_body = 'user'.$profileData['users_id'];
            $uploadUtils->image_resize = true;
            $uploadUtils->image_x = 150;
            $uploadUtils->image_ratio_y = true;
            $uploadUtils->file_overwrite = true; 
            $uploadUtils->process(ROOT_PATH.'/public/img/avatar/');
            
            if ($uploadUtils->processed) {
            	$uploadUtils->clear();
            	
                $old_image_file  =  ROOT_PATH.'/public'.$profileData["profile_pic_url"];
            	$new_image_url   =  '/img/avatar/'.$uploadUtils->getProcessedFile();
                
                //updateDB
            	$this->getProfileTable()->updateProfilePicture($profileData['users_id'],$new_image_url);
            	
            	//delete old profile picture 
            	if(file_exists($old_image_file)){
            		   unlink($old_image_file); 
            	}
            	
                // set success 	
            	$this->flashMessenger ()->addSuccessMessage ( "Profile picture updated successfully!");
            
            } else {
            	
            	$this->flashMessenger ()->addSuccessMessage ( "$uploadUtils->error");
            	return $this->redirect()->toRoute('profile',array('action'=>'upload-profile-picture'));
            }
            
            // Form is valid, save the form!
            return $this->redirect()->toRoute('profile',array('action'=>'view'));
        }
    }

      return array(
        'form'     => $form,
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