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
            array_push($comentarios[$comment->getCommentNews()], $comment);
        }
        
        
        return new ViewModel(array('comments' => $comments, 'comentarios' => $comentarios));
    }
    
    public function addAction()
    {
        $request = $this->getRequest();
        $this->layout('layout/ajax_layout.phtml');
        echo $request->getPost('comment_content');
        /*$request = $this->getRequest();
        
        if($request->isPost())
        {         
            $news = $this->getEntityManager()->getRepository('Application\Entity\News')->createQueryBuilder('n')->select()->where('n.newsId = '.$request->getPost('newsId')->getQuery()->getResult());
            
            if(empty($news)) echo "Você tentou comentar numa Notícia inexistente!";
            else 
            {
                $c = new Comment();
                $c->setCommentAuthorIp($_SERVER['REMOTE_ADDR']);
                $c->setCommentContent($request->getPost('comment_content'));
                $c->setCommentDate(new \DateTime('now'));
                $c->setCommentNews($news[0]);
                $c->setCommentTitle($request->getPost('comment_title'));            
            
                $this->getEntityManager()->persist($c);
                $this->getEntityManager()->flush();
                
                echo "Comentário postado com sucesso!";
            }
        }*/
    }
}

