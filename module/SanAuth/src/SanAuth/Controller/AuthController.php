<?php

namespace SanAuth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use SanAuth\Model\User;
use SanAuth\Model\SanAuthTable;
use SanAuth\Model\SanAuth;
use SanAuth\Form\LoginForm;
use SanAuth\Model\LoginFormFilter;
use Hr\Model\HrTable;
use Hr\Model\Hr;
use Zend\View\Helper\ViewModel;


class AuthController extends AbstractActionController 
{
	protected $authTable;
    protected $storage;
    protected $authservice;
    protected $empLoginsTable;

    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                                      ->get('AuthService');
        }

        return $this->authservice;
    }

    public function getSessionStorage()
    {
        if (! $this->storage) {
            $this->storage = $this->getServiceLocator()
                                  ->get('SanAuth\Model\MyAuthStorage');
        }
         //added
         $this->storage->setDbHandler();
        return $this->storage;
    }



    public function loginAction()
    {
        //if already login, redirect to success page
        if ($this->getAuthService()->hasIdentity()) {
            return $this->redirect()->toRoute('success');
        }

       $form = new LoginForm();
       
        return array(
            'form'      => $form
        );
    }
    
    public function registerAction(){
    	
    }

    /**
     * authenticate post username and password
     */
    public function authenticateAction(){
        $form = new LoginForm();
        $redirect = 'login';
        
        $request = $this->getRequest();
        if ($request->isPost()) {
			$username = $request->getPost ( 'username' );
			$password = $request->getPost ( 'password' );
			$remember_me = $request->getPost ( 'remember_me' );
        	
        	if(empty($username)&&
               empty($password)){
        		$this->flashmessenger()->addErrorMessage("Please provide a username and password");
        		return $this->redirect()->toRoute($redirect);
        	}
            
                //check authentication...
                $this->getAuthService()->getAdapter()
                                       ->setIdentity($username)
                                       ->setCredential($password);
                

                $result = $this->getAuthService()->authenticate();
                
                foreach ($result->getMessages() as $message) {
                    //save message temporary into flashmessenger
                    $this->flashmessenger()->addMessage($message);
                }

                if ($result->isValid()) {
                    $redirect = 'home';
                    $action = "index";
                    //check if it has rememberMe :
                    if ($remember_me == 1 ) {
                        $this->getSessionStorage()
                             ->setRememberMe(1);
                        //set storage again
                        $this->getAuthService()->setStorage($this->getSessionStorage());
                    }
                    $this->getAuthService()->setStorage($this->getSessionStorage());
         
                    $loginDetails = $this->getAuthTable()->getProfileInfoByUserName($username);
                    
              
                     if($loginDetails["role"]=="hr-manager"){
                     	$redirect = "profile";
                     	$action = "index";
                     	$subRole = array('subRole'=>'hr-manager');
                     	$loginDetails = array_merge($subRole,$loginDetails);
            
                     	
                     }else if($loginDetails["role"]=="client"){
                     	$redirect = "client";
                     	$action = "mystaff";
                     }else if($loginDetails["role"]=="employee"){
                     	$redirect = "profile";
                     	$action = "view";
                     }
                    
      
                    $this->getAuthService()->getStorage()->write($loginDetails);
        
                    
                    //login
                     $emp_id  = $this->getAuthTable()->getEmployeeId($loginDetails["id"]);
               
                     $debug['id'] = $loginDetails["id"];
                     $debug['emp_id'] = $emp_id;
              
                     if($emp_id!=null){
                     	$this->getAuthTable()->logInLogOut($emp_id,1);
                     }
                                          
                }
        }

        return $this->redirect()->toRoute($redirect,array('action'=>$action));
    }

    public function logoutAction()
    {
        if ($this->getAuthService()->hasIdentity()) {
        	
        	$identity = $this->getAuthService()->getIdentity();
        	
            $this->getSessionStorage()->forgetMe();
            $this->getAuthService()->clearIdentity();
            $this->flashmessenger()->addMessage("You've been logged out");
            $this->getAuthTable()->logInLogOut($identity["id"],0);
        }

        return $this->redirect()->toRoute('login');
    }
    
    
	public function getAuthTable(){
		if (!$this->authTable) {
			$sm = $this->getServiceLocator();
			$this->authTable = $sm->get('SanAuth\Model\SanAuthTable');
		}
		return $this->authTable;
	}
}
