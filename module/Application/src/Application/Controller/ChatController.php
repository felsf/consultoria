<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ChatController extends AbstractActionController 
{	
    public function indexAction()
    {    	
    	return new ViewModel();
    }

    public function startAction()
    {
        $this->layout('layout/chat_layout.phtml');        
    }
}