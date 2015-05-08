<?php

namespace SanAuth\Model;

use Zend\Authentication\Storage;

class MyAuthStorage extends Storage\Session
{
    public function setRememberMe($rememberMe = 0, $time = 1209600)
    {
        if ($rememberMe == 1) {
            $this->session->getManager()->rememberMe($time);
        }
    }

    public function forgetMe()
    {
        $this->session->getManager()->forgetMe();
    }
    
    /*Set tableGateway as save handler
    
    muscreate a table session
    
    CREATE TABLE IF NOT EXISTS `session` (
  `id` char(32) NOT NULL DEFAULT '',
  `name` char(32) NOT NULL DEFAULT '',
  `modified` int(11) DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    
    */
      public function setDbHandler()
    {
        $tableGateway = new TableGateway('session', $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
        $saveHandler = new DbTableGateway($tableGateway, new DbTableGatewayOptions());

        //open session
        $sessionConfig = new SessionConfig();
        $saveHandler->open($sessionConfig->getOption('save_path'), $this->namespace);
        $this->session->getManager()->setSaveHandler($saveHandler);
    }
}
