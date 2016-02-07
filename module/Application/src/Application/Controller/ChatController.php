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
        $qb = $this->getEntityManager()->getRepository("Application\Entity\Chat")->createQueryBuilder('c');
        
        $newChat = rand(1, 1000000);
        $chat = $qb->select()->where('c.chatId = '.$newChat)->getQuery()->getResult();

        while(!empty($chat))
        {
            $newChat = rand(1, 1000000);
            $chat = $qb->select()->where('c.chatId = '.$newChat)->getQuery()->getResult();
        }     
        
        return new ViewModel(array('newChat' => $newChat));
    }
    
    public function sendAction()
    {
        $this->layout('layout/empty_layout.phtml');
        $request = $this->getRequest();

        if($request->isPost())
        {            
            echo json_encode($request->getPost('typemsg'));
        }        
    }
    
    public function displayAction()
    {
        $this->layout('layout/empty_layout.phtml');
    }
    
    public function deleteAction()
    {
        
    }
}