<?php 
namespace Hr;


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
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
						) 
				) 
		);
	}
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}
	
	//Factories Service manager
	public function getServiceConfig() {
		return array (
				'factories' => 
				array (
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
						}
				),
		);
	}


	
}
?>