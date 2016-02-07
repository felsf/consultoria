<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Message;
use Application\Entity\Chat;

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
        
        $chat = new Chat();
        $chat->setChatId($newChat);
        $chat->setChatActive(1);
        
        $this->getEntityManager()->persist($chat);
        $this->getEntityManager()->flush();        

        return new ViewModel(array('newChat' => $newChat));
    }
    
    public function sendAction()
    {
        $this->layout('layout/empty_layout.phtml');
        $request = $this->getRequest();

        if($request->isPost())
        {   
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Chat")->createQueryBuilder('c');
            $chat = $qb->select()->where("c.chatId = ".$request->getPost('chatid'))->getQuery()->getResult();
            
            $msg = new Message();
            $msg->setChat($chat[0]);
            $msg->setMessageContent($request->getPost('typemsg'));
            $this->getEntityManager()->persist($msg);
            $this->getEntityManager()->flush();           
                  
            $data = array($msg->getMessageId(), $request->getPost('typemsg'));
            echo json_encode($data);            
        }        
    }
    
    public function displayAction()
    {
        $this->layout('layout/empty_layout.phtml');
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Message")->createQueryBuilder('m');
            $chat = $this->getEntityManager()->getRepository("Application\Entity\Chat")->createQueryBuilder('c')
                    ->select()->where("c.chatId = ".$request->getPost('chatid'))->getQuery()->getResult();
            $msgs = $qb->select()->where("m.chat = ".$chat[0]->getChatId())->getQuery()->getResult();
            
            $data = array(); 
            foreach($msgs as $msg) {
                array_push($data, $msg->getMessageContent());
            }
            
            echo json_encode($data);
        }
    }
    
    public function deleteAction()
    {
        
    }
}