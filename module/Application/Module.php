<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Permissions\Acl\Acl;
//logging
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;


use Hr\Model\Hr;
use Hr\Model\HrTable;

//EmployeeFileTable
use Hr\Model\EmployeeFile;
use Hr\Model\EmployeeFileTable;

//EmployeeMemoTable
use Hr\Model\EmployeeMemo;
use Hr\Model\EmployeeMemoTable;


//EmployeeMemoTable
use Hr\Model\EmployeeQuiz;
use Hr\Model\EmployeeQuizTable;

//Employee logins
use Hr\Model\EmployeeLogins;
use Hr\Model\EmployeeLoginsTable;

//Employee evaluations
use Hr\Model\EmployeeEvaluations;
use Hr\Model\EmployeeEvaluationsTable;

//Employee Salary
use Hr\Model\EmployeeSalary;
use Hr\Model\EmployeeSalaryTable;

//Employee Feedback
use Hr\Model\EmployeeFeedback;
use Hr\Model\EmployeeFeedbackTable;


class Module{
	
	protected $logger;
	
    public function onBootstrap(MvcEvent $e)
    {
    	$application         = $e->getApplication();
        $eventManager        = $application->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $eventManager -> attach('route', array($this, 'loadCommonViewVars'));
    }

    
    private function isOpenRequest(MvcEvent $e) {
    	if ($e->getRouteMatch ()->getParam ( 'controller' ) == 'SanAuth\Controller\AuthController') {
    		return true;
    	}
    
    	return false;
    }
    
    /**
     * @description Sets some variables for usage in any view
     * @param MvcEvent $e
     */
    public function loadCommonViewVars(MvcEvent $e) {
    	// redirect to login
 
        //$this->getLogger()->debug($e->getRouteMatch()->getMatchedRouteName());
    	
    	$auth = null;

    	if (! $this->isOpenRequest ( $e )) {
    		
    		$auth = $e->getApplication()->getServiceManager()->get('AuthService')->getStorage ()->read ();

    		if ("NULL" === $auth &&  null === $auth) {

    			$e->getRouteMatch ()->setParam ('controller', 'SanAuth\Controller\Auth' )->setParam ( 'action', 'index' );
    		    
    			
    		}else{

    			if($auth['users_id']!=null){
    				$dbAdapter = $e->getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
    				$sql = "SELECT 
    				users.user_name,
    				users.role,
    				users.email,
    				user_profile.firstname,
    				user_profile.lastname,
    				user_profile.middle,
    				DATE_FORMAT(user_profile.birthdate,'%b %d, %Y') as birthdate,
    				user_profile.address,
    				user_profile.landline,
    				user_profile.cellphone,
    				user_profile.birthdate,
    				user_profile.gender_id,
    				user_profile.profile_pic_url,
    				user_profile.about,
    				DATE_FORMAT(user_profile.created,'%b %d, %Y') as created,
    				DATE_FORMAT(user_profile.last_modified,'%b %d, %Y @ %h:%i %p') as last_modified
    				FROM users
    				LEFT JOIN user_profile
    				ON users.id = user_profile.users_id
    				WHERE users.id = {$auth['users_id']}";
    				
    				$results = $dbAdapter->query($sql)->execute();
    			    $auth = $results->current();
    			    
    			}
    			
    			//acl
    			//http://ivangospodinow.com/zend-framework-2-acl-setup-in-5-minutes-tutorial/
    			$acl = new Acl();
    			
    			//$roles = include __DIR__ . '/config/module.acl.roles.php';
    			
    			$roles = $this->getAclDbRoles($e);
    	 

    			
    			$allResources = array();
    			
    			foreach ($roles as $role => $resources) {
    			
    				$role = new \Zend\Permissions\Acl\Role\GenericRole($role);
    				$acl -> addRole($role);
    			
    				$allResources = array_merge($resources, $allResources);
    			
    				//adding resources
    				foreach ($resources as $resource) {
    					if(!$acl ->hasResource($resource))
    						$acl -> addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resource));
    				}
    				//adding restrictions
    				//If access inheritance is needed just replace bellow code from-> foreach ($resources as $resource) { to -> foreach ($allResources as $resource) { 
    				foreach ($resources as $resource) {
    					$acl -> allow($role, $resource);
    				}
    			}
    	
    			$e->getViewModel()->setVariables(array('auth' => $auth,
    			                                        'acl'=>$acl));
    			
    			
    	        $resource = $e -> getRouteMatch()->getParam("action");
    	        
    	        if($auth['role']==null){
    	        	$auth['role'] = 'guest';
    	        }

    	       
    	        $allowed = (bool)$acl->isAllowed($auth['role'],$resource);
    	        
    	        $debug['role'] = $auth['role'];
    	        $debug['resource'] = $resource;
    	        $debug['allowed'] = $allowed;
    	        //var_dump($debug);
    	       
    	        if(!$allowed){
    	           //TODO:redirect to forbidden page error
    	        	echo "your are not allowed to view this resource";
    	           exit;
    	        }
    	        
    		}
    	}
    	
    
	}
	
	
	
	
 public function getAclDbRoles(MvcEvent $e){
 	$dbAdapter = $e->getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
 	$results = $dbAdapter->query('SELECT * FROM acl_roles ORDER BY role ASC')->execute();
 	$roles = array();
 	foreach($results as $result){
 		$roles[$result['role']][] = $result['resource'];
 	}
 	
 	return $roles;
 }
	
	
	private function getLogger(){
		if(!$this->logger){
			//build
			if(!file_exists('/tmp/sourcefit/sms.log')){
				@mkdir(dirname('/tmp/sourcefit'), 0777, true);
				$logFile = fopen("/tmp/sourcefit/sms.log", "w");
				fclose($logFile);
				
			}
			$this->logger = new Logger();
			$this->logger->addWriter(new Stream('/tmp/sourcefit/sms.log'));
		}
	
		return $this->logger;
	}
	

    public function getConfig(){
        return include __DIR__ . '/config/module.config.php';
    }
    
    
    public function getServiceConfig() {
    	return array (
    
    			'factories' => array (
    
    					'SanAuth\Model\MyAuthStorage' => function ($sm) {
    						return new \SanAuth\Model\MyAuthStorage ( 'sms_storage' );
    					},
    
    					'AuthService' => function ($sm) {
    						$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
    						    // I'm going to change the password encryption from Md5 to  BCrypt 
    						//$dbTableAuthAdapter = new DbTableAuthAdapter ( $dbAdapter, 'users', 'user_name', 'pass_word', 'MD5(?)' );
    						
//     						if ($bcrypt->verify("iloveyou","\$2y\$10\$yRz2geYWuRg4bgK5v5pN3O89PVOpQa0sk7uGMBzD3n7sEVuy5GmCa")) {
//     							echo "The password is correct! \n";
//     						} else {
//     							echo "The password is NOT correct.\n";
//     						}
    						
    						$dbTableAuthAdapter = new DbTableAuthAdapter ( $dbAdapter, 'users', 'user_name', 'pass_word', '' );
    							
    						$authService = new AuthenticationService ();
    						$authService->setAdapter ( $dbTableAuthAdapter );
    						$authService->setStorage ( $sm->get('SanAuth\Model\MyAuthStorage'));
    
    						return $authService;
    					},
    					
    					
    					'Hr\Model\HrTable' => function ($sm) {
    						$tableGateway = $sm->get ( 'ProfileTableGateway' );
    						$table = new HrTable ( $tableGateway );
    						return $table;
    					},
    					'HrTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
    						$resultSetPrototype = new ResultSet ();
    						$resultSetPrototype->setArrayObjectPrototype ( new Hr () );
    						return new TableGateway ( 'users', $dbAdapter, null, $resultSetPrototype );
    					},
    					'Hr\Model\EmployeeFileTable' => function ($sm) {
    						$tableGateway = $sm->get ( 'EmployeeFileTableGateway' );
    						$table = new EmployeeFileTable ( $tableGateway );
    						return $table;
    					},
    					'EmployeeFileTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
    						$resultSetPrototype = new ResultSet ();
    						$resultSetPrototype->setArrayObjectPrototype ( new EmployeeFile () );
    						return new TableGateway ( 'employee_files', $dbAdapter, null, $resultSetPrototype );
    					},
    					'Hr\Model\EmployeeMemoTable' => function ($sm) {
    						$tableGateway = $sm->get ( 'EmployeeMemoTableGateway' );
    						$table = new EmployeeMemoTable ( $tableGateway );
    						return $table;
    					},
    					'EmployeeMemoTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
    						$resultSetPrototype = new ResultSet ();
    						$resultSetPrototype->setArrayObjectPrototype ( new EmployeeMemo() );
    						return new TableGateway ( 'employee_memo', $dbAdapter, null, $resultSetPrototype );
    					},
    					'Hr\Model\EmployeeQuizTable' => function ($sm) {
    						$tableGateway = $sm->get ( 'EmployeeQuizTableGateway' );
    						$table = new EmployeeQuizTable ( $tableGateway );
    						return $table;
    					},
    					'EmployeeQuizTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
    						$resultSetPrototype = new ResultSet ();
    						$resultSetPrototype->setArrayObjectPrototype ( new EmployeeQuiz() );
    						return new TableGateway ( 'employee_quiz', $dbAdapter, null, $resultSetPrototype );
    					},
    					'Hr\Model\EmployeeLoginsTable' => function ($sm) {
    						$tableGateway = $sm->get ( 'EmployeeLoginsTableGateway' );
    						$table = new EmployeeLoginsTable ( $tableGateway );
    						return $table;
    					},
    					'EmployeeLoginsTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
    						$resultSetPrototype = new ResultSet ();
    						$resultSetPrototype->setArrayObjectPrototype ( new EmployeeLogins() );
    						return new TableGateway ( 'employee_logins', $dbAdapter, null, $resultSetPrototype );
    					},
    					'Hr\Model\EmployeeEvaluationsTable' => function ($sm) {
    						$tableGateway = $sm->get ( 'EmployeeEvaluationsTableGateway' );
    						$table = new EmployeeEvaluationsTable ( $tableGateway );
    						return $table;
    					},
    					'EmployeeEvaluationsTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
    						$resultSetPrototype = new ResultSet ();
    						$resultSetPrototype->setArrayObjectPrototype ( new EmployeeEvaluations() );
    						return new TableGateway ( 'employee_evaluation', $dbAdapter, null, $resultSetPrototype );
    					},
    					'Hr\Model\EmployeeSalaryTable' => function ($sm) {
    						$tableGateway = $sm->get ( 'EmployeeSalaryTableGateway' );
    						$table = new EmployeeSalaryTable ( $tableGateway );
    						return $table;
    					},
    					'EmployeeSalaryTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
    						$resultSetPrototype = new ResultSet ();
    						$resultSetPrototype->setArrayObjectPrototype ( new EmployeeSalary() );
    						return new TableGateway ( 'employee_salary', $dbAdapter, null, $resultSetPrototype );
    					},
    					
    					'Hr\Model\EmployeeFeedbackTable' => function ($sm) {
    						$tableGateway = $sm->get ( 'EmployeeFeedbackTableGateway');
    						$table = new EmployeeFeedbackTable( $tableGateway );
    						return $table;
    					},
    					'EmployeeFeedbackTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
    						$resultSetPrototype = new ResultSet ();
    						$resultSetPrototype->setArrayObjectPrototype ( new EmployeeFeedback() );
    						return new TableGateway ( 'employee_feedback', $dbAdapter, null, $resultSetPrototype );
    					},
    			),
    	);
    }

    public function getAutoloaderConfig(){
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 'MarvinFileUploadUtils' => __DIR__ . '/../../vendor/MarvinFileUploadUtils',
                ),
            ),
        );
    }
}
