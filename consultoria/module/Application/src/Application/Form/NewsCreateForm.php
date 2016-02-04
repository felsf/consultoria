<?php
namespace Application\Form;

use Zend\Form\Form;

class NewsCreateForm extends Form
{
    public function __construct()
    {
        parent::__construct("NewsCreateForm");
        
        $this->add(array('name' => 'news-title', 'type' => 'text', 'options' => array('label' => 'Título da Notícia'), 'attributes' => array('required' => true, 'style' => 'min-width: 300px;', 'class' => 'form-control')));
        $this->add(array('name' => 'news-content', 'type' => 'textarea', 'options' => array('id' => 'news-content', 'cols' => 10, 'rows' => 80), 'attributes' => array('required' => true, 'class' => 'form-control')));
        $this->add(array('name' => 'news-source', 'type' => 'text', 'options' => array('label' => 'Fonte da Notícia'), 'attributes' => array('style' => 'min-width: 300px', 'class' => 'form-control')));        
    }
}

?>