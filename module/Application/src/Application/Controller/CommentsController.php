<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Comment;
use Application\Entity\News;


class CommentsController extends AbstractActionController
{
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

