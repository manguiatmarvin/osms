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


	
}
?>