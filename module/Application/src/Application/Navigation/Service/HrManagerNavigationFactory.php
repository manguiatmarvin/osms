<?php 
namespace Application\Navigation\Service;


use Zend\Navigation\Service\DefaultNavigationFactory;

class HrManagerNavigationFactory extends DefaultNavigationFactory
{
	protected function getName(){
		return 'hr-manager-menu';
	}
}



?>