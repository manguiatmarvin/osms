<?php

namespace SanAuth\Model;

use Zend\Form\Annotation;


class User implements InputFilterAwareInterface
{
    public $username;
    public $password;
    public $rememberme;
    public $submit;
    
    
    public function exchangeArray($data)
    {
    	$this->username     = (!empty($data['username'])) ? $data['username'] : null;
    	$this->password = (!empty($data['password'])) ? $data['password'] : null;
    	$this->remember_me = (!empty($data['remember_me'])) ? $data['remember_me'] : null;
    	$this->submit = (!empty($data['submit'])) ? $data['submit'] : null;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }

    
}
