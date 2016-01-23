<?php
namespace Application\Form;

use Zend\Form\Form;

class UserLoginForm extends Form
{
    public function __construct()
    {
        parent::__construct("UserLoginForm");
    
        $this->add(array('name' => 'user_login', 'type' => 'text', 'options' => array('label' => 'Login de Acesso',), 'attributes' => array('class' => 'form-control')));        
        $this->add(array('name' => 'user_password', 'type' => 'password', 'options' => array('label' => 'Senha',), 'attributes' => array('class' => 'form-control')));        
    }
}

?>