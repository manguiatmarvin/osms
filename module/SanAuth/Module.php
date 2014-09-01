<?php

namespace SanAuth;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use SanAuth\Model\SanAuthTable;
use SanAuth\Model\SanAuth;



class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
            // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
		return include __DIR__ . '/config/module.config.php';
	}
	

	public function getServiceConfig(){
		return array(
				'factories' => array(
						'SanAuth\Model\SanAuthTable' =>  function($sm) {
							$tableGateway = $sm->get('SanAuthTableGateway');
							$table = new SanAuthTable($tableGateway);
							return $table;
						},
						'SanAuthTableGateway' => function ($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new SanAuth());
							return new TableGateway('user_profile', $dbAdapter, null, $resultSetPrototype);
						},
				),
		);
	}
}
