<?php
namespace Application\Form;

use Zend\Form\Form;

class UserRegisterForm extends Form
{
    public function __construct()
    {
        parent::__construct("UserRegisterForm");
        
        $this->add(array('name' => 'user_login', 'type' => 'text', 'options' => array('label' => 'Login de Acesso',), 'attributes' => array('class' => 'form-control')));
        $this->add(array('name' => 'user_name', 'type' => 'text', 'options' => array('label' => 'Nome',), 'attributes' => array('class' => 'form-control')));
        $this->add(array('name' => 'user_email', 'type' => 'email', 'options' => array('label' => 'Email',), 'attributes' => array('class' => 'form-control')));
        $this->add(array('name' => 'user_password', 'type' => 'password', 'options' => array('label' => 'Senha',), 'attributes' => array('class' => 'form-control')));
        $this->add(array('name' => 'btn-submit', 'type' => 'submit', 'attributes' => array('class' => 'btn btn-lg btn-info', 'value' => 'Cadastrar')));
    }
}

?>