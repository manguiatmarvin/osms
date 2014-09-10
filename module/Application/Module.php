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

class Module{
	
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
    	$auth = null;

    	if (! $this->isOpenRequest ( $e )) {
    		
    		$auth = $e->getApplication()->getServiceManager()->get('AuthService')->getStorage ()->read ();

    		if ("NULL" === $auth &&  null === $auth) {
    			// redirect to login
    			$e->getRouteMatch ()->setParam ('controller', 'SanAuth\Controller\Auth' )->setParam ( 'action', 'index' );
    		
    		}else{

    			if($auth['users_id']!=null){
    				$dbAdapter = $e->getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
    				$sql = "SELECT 
    				users.user_name,
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
    			$roles = include __DIR__ . '/config/module.acl.roles.php';
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
    				foreach ($allResources as $resource) {
    					$acl -> allow($role, $resource);
    				}
    			}
    			//testing
    			//var_dump($acl->isAllowed('admin','home'));
    			//true
    			$e->getViewModel()->setVariables(array('auth' => $auth,
    			                                        'acl'=>$acl));
    			
    		}
    	}
    	
    
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
