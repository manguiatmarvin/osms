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


class Module{
	
    //Means i can display authentication information in any view / layout rather than having to pass it in the view modal
	
    public function onBootstrap(MvcEvent $e)
    {
    	$application         = $e->getApplication();
        $eventManager        = $application->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $eventManager->attach('dispatch', array($this, 'loadCommonViewVars'), 100);
      
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
    		
    		if ("" === $auth &&  null === $auth) {
    			$e->getRouteMatch ()->setParam ('controller', 'SanAuth\Controller\Auth' )->setParam ( 'action', 'index' );
    		
    		}else{
    			 // access details in layout eg. $this->layout->auth['user_name']
    			$e->getViewModel()->setVariables(array('auth' => $auth));
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
                ),
            ),
        );
    }
}
