<?php 
namespace Application\Navigation\Service;


use Zend\Navigation\Service\DefaultNavigationFactory;

class ClientNavigationFactory extends DefaultNavigationFactory
{
	protected function getName(){
		return 'client_menu';
	}
}


?>