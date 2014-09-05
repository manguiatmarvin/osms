<?php 
namespace Hr;


use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

use Hr\Model\Hr;
use Hr\Model\HrTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
	public function getAutoloaderConfig()
	{
		return array(
				'Zend\Loader\ClassMapAutoloader' => array(
						__DIR__ . '/autoload_classmap.php',
				),
				'Zend\Loader\StandardAutoloader' => array(
						'namespaces' => array(
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
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
						'Hr\Model\HrTable' =>  function($sm) {
							$tableGateway = $sm->get('ProfileTableGateway');
							$table = new HrTable($tableGateway);
							return $table;
						},
						'HrTableGateway' => function ($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Hr());
							return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
						},
				),
		);
	}


	
}
?>