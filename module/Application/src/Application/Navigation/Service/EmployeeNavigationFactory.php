<?php 
namespace Application\Navigation\Service;


use Zend\Navigation\Service\DefaultNavigationFactory;

class EmployeeNavigationFactory extends DefaultNavigationFactory
{
	protected function getName(){
		return 'employee-menu';
	}
}



?>