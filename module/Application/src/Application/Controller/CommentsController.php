<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Comment;

use Zend\Mvc\MvcEvent;

class CommentsController extends AbstractActionController
{
    public function onDispatch(MvcEvent $e)
    {
        $logged_block = array('add');        
        if(!$this->identity() && !in_array($e->getRouteMatch()->getParam("action"), $logged_block)) return $this->redirect()->toRoute('home');
        return parent::onDispatch($e);              
    }

    public function indexAction()
    {        
        $qb = $this->getEntityManager()->getRepository("Application\Entity\Comment")->createQueryBuilder('c');        
        
        $comments = $qb->select()->orderBy('c.commentDate', 'DESC')->getQuery()->getResult();               
        
        
        return new ViewModel(array('comments' => $comments));
    }

    public function deleteAction()
    {
        $id = $this->params('id');
        $request = $this->getRequest();
        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Comment")->createQueryBuilder('c');
            $comment = $qb->select()->where('c.commentId = '.$id)->getQuery()->getResult();
        
            if(empty($comment)) return $this->redirect()->toRoute('news');
            $comment = $comment[0];
            
            $this->getEntityManager()->remove($comment);
            $this->getEntityManager()->flush();
             
            $this->flashMessenger()->addSuccessMessage("Comentário Apagado com sucesso!");
            return $this->redirect()->toRoute('comments');
        }
    }
    
    public function addAction()
    {
        $request = $this->getRequest();
        $this->layout('layout/ajax_layout.phtml');              
            
            if($request->isPost())
            {                                                                   
                    $c = new Comment();
                    $c->setCommentAuthor($request->getPost('comment_author'));                    
                    $c->setCommentAuthorIp($_SERVER['REMOTE_ADDR']);
                    $c->setCommentContent($request->getPost('comment_content'));
                    $c->setCommentDate(new \DateTime('now'));                    
                    $c->setCommentTitle("");                                
                
                    $this->getEntityManager()->persist($c);
                    $this->getEntityManager()->flush();   
                    
                    $this->flashMessenger()->addInfoMessage("Comentário postado com sucesso!");
                    return $this->redirect()->toRoute('home');                    
                 
            }          
    }
}

