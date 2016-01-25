<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Comment;
use Application\Entity\News;


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
        $nqb = $this->getEntityManager()->getRepository("Application\Entity\News")->createQueryBuilder('n');
        
        $comments = $qb->select()->orderBy('c.commentDate', 'DESC')->getQuery()->getResult();
        $news = $nqb->select()->where('n.newsPublished = 1')->orderBy('n.newsId', 'ASC')->getQuery()->getResult();
        
        $comentarios = array();
        
        foreach($news as $noticia)
        {
            if(!array_key_exists($noticia->getNewsId(), $comentarios)) $comentarios[$noticia->getNewsId()] = array();           
        }
        
        foreach($comments as $comment)
        {
            array_push($comentarios[$comment->getCommentNews()->getNewsId()], $comment);
        }
        
        
        return new ViewModel(array('comments' => $comments, 'comentarios' => $comentarios));
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
                $id = $request->getPost('comment_news');                    
                $qb = $this->getEntityManager()->getRepository('Application\Entity\News')->createQueryBuilder('n');           
                $news = $qb->select()->where('n.newsId = '.$id)->getQuery()->getResult();
                
                if(empty($news)) echo "Você tentou comentar numa Notícia inexistente!";            
                else 
                {                    
                    $c = new Comment();
                    $c->setCommentAuthor($request->getPost('comment_author'));
                    $c->setCommentNews($news[0]);
                    $c->setCommentAuthorIp($_SERVER['REMOTE_ADDR']);
                    $c->setCommentContent($request->getPost('comment_content'));
                    $c->setCommentDate(new \DateTime('now'));
                    $c->setCommentNews($news[0]);
                    $c->setCommentTitle("");                                
                
                    $this->getEntityManager()->persist($c);
                    $this->getEntityManager()->flush();   
                    
                    $this->flashMessenger()->addInfoMessage("Comentário postado com sucesso!");
                    $this->redirect()->toRoute('home');                    
                } 
            }          
    }
}

