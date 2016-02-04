<?php
namespace Application\Form;

use Zend\Form\Form;

class QuestionForm extends Form
{
    public function __construct()
    {
        parent::__construct("QuestionForm");

        $this->add(array('name' => 'question_title', 'type' => 'textarea', 'options' => array('label' => 'Digite sua pergunta'), 'attributes' => array('required' => true, 'style' => 'min-height: 200px; max-height: 500px; min-width: 500px; max-width: 1000px', 'class' => 'form-control comment-input')));
        $this->add(array('name' => 'question_author', 'type' => 'text', 'options' => array('label' => 'Digite seu nome'), 'attributes' => array('class' => 'form-control', 'required' => true)));
        $this->add(array('name' => 'question_author_email', 'type' => 'email', 'options' => array('label' => 'Digite seu email'), 'attributes' => array('required' => true, 'class' => 'form-control')));
	}
}