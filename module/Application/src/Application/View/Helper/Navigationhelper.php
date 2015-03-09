<?php 
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;


class Navigationhelper extends AbstractHelper
{
	public function __invoke($p){
	foreach ($p as $c){
		if($c->isActive()){
			return true;
		}
	}
	return false;
	}
	

}

?>