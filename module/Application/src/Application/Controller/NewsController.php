<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Form\NewsCreateForm;

use Application\Entity\News;
use Zend\Mvc\MvcEvent;

class NewsController extends AbstractActionController
{
    public function onDispatch(MvcEvent $e)
    {
        $logged_block = array('view', 'all');
        if(!$this->identity() && !in_array($e->getRouteMatch()->getParam("action"), $logged_block)) return $this->redirect()->toRoute('home');        
        return parent::onDispatch($e);
    }
    
    public function indexAction()
    {
        $qb = $this->getEntityManager()->getRepository("Application\Entity\News")->createQueryBuilder('n');
        $news = $qb->select()->orderBy('n.newsDate', 'DESC')->getQuery()->getResult();
        foreach($news as $noticia)
        {
            $noticia->setNewsTitle(substr($noticia->getNewsTitle(), 0, 20).".....");
            $noticia->setNewsSource(substr($noticia->getNewsSource(), 0, 10)."....");                
        }
        return new ViewModel(array('news' => $news));
    }
    
    public function createAction()
    {
        $newsForm = new NewsCreateForm();
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $news = new News();
            
            $news->setNewsAuthor($this->identity());
            $news->setNewsContent(htmlspecialchars($request->getPost('news-content')));
            $news->setNewsDate(new \DateTime('now'));
            $news->setNewsTitle($request->getPost('news-title'));
            $news->setNewsSource($request->getPost('news-source'));            
            
            if(isset($request->getPost()['btn-publish'])) // Publica Diretamente
            {
                $news->setNewsPublished(true);
                $this->getEntityManager()->persist($news);
                $this->getEntityManager()->flush();
                
                $this->flashMessenger()->addSuccessMessage('Notícia Publicada com sucesso: '.$news->getNewsTitle());
            }
            
            elseif(isset($request->getPost()['btn-save'])) // Salve como Rascunho.
            {
                $news->setNewsPublished(false);
                $this->getEntityManager()->persist($news);
                $this->getEntityManager()->flush();      

                $this->flashMessenger()->addInfoMessage('Notícia Salva com sucesso: '.$news->getNewsTitle());
            }            
            
            $this->redirect()->toRoute('news');
        }
        
        return new ViewModel(array('newsForm' => $newsForm));
    }
    
    public function publishAction()
    {
        $id = $this->params('id');
        $request = $this->getRequest();
        
        $id = $this->params('id');
        $request = $this->getRequest();
        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\News")->createQueryBuilder('n');
            $news = $qb->select()->where('n.newsId = '.$id)->getQuery()->getResult();
        
            if(empty($news)) return $this->redirect()->toRoute('news');
            $news = $news[0];
            
            if(!$news->getNewsPublished())
            {
                $news->setNewsPublished(true);
                $this->flashMessenger()->addInfoMessage('Notícia Salva como Rascunho com sucesso: '.$news->getNewsTitle());
            }
            else
            {
                $news->setNewsPublished(false);
                $this->flashMessenger()->addInfoMessage('Notícia Publicada com sucesso: '.$news->getNewsTitle());
            }
            
            $this->getEntityManager()->persist($news);
            $this->getEntityManager()->flush();
            
            return $this->redirect()->toRoute('news');            
        }
    }
    
    public function editAction()
    {
        $id = $this->params('id');
        $request = $this->getRequest();
        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\News")->createQueryBuilder('n');
            $news = $qb->select()->where('n.newsId = '.$id)->getQuery()->getResult();         
            
            if(empty($news)) return $this->redirect()->toRoute('news');            
            $news = $news[0];
            
            if($request->isPost())
            {            
                $news->setNewsContent(htmlspecialchars($request->getPost('news-content')));
                $news->setNewsEditDate(new \DateTime('now'));
                $news->setNewsTitle($request->getPost('news-title'));
                $news->setNewsSource($request->getPost('news-source'));
                
                if(isset($request->getPost()['btn-publish'])) // Publica Diretamente
                {
                    $news->setNewsPublished(true);
                    $this->getEntityManager()->persist($news);
                    $this->getEntityManager()->flush();
                
                    $this->flashMessenger()->addSuccessMessage('Notícia Publicada com sucesso: '.$news->getNewsTitle());
                }
                
                elseif(isset($request->getPost()['btn-save'])) // Salve como Rascunho.
                {
                    $news->setNewsPublished(false);
                    $this->getEntityManager()->persist($news);
                    $this->getEntityManager()->flush();
                
                    $this->flashMessenger()->addInfoMessage('Notícia Salva com sucesso: '.$news->getNewsTitle());
                }
                
                $this->redirect()->toRoute('news');
            }    
                        
            return new ViewModel(array('news' => $news, 'newsForm' => new NewsCreateForm()));
        }              
        
        else return $this->redirect()->toRoute('news');
    }
    
    public function viewAction()
    {
        $id = $this->params('id');
        $request = $this->getRequest();
        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Comment")->createQueryBuilder('c');
            $nqb = $this->getEntityManager()->getRepository("Application\Entity\News")->createQueryBuilder('n');
            $news = $nqb->select()->where('n.newsId = '.$id)->getQuery()->getResult();
        
            if(empty($news)) return $this->redirect()->toRoute('news');
            $news = $news[0];
            
            $comments = $qb->select()->where('c.commentNews = '.$id)->orderBy('c.commentDate', 'DESC')->getQuery()->getResult();            
        
            $comentarios = array();        
            $comentarios[$id] = array();            
            
            foreach($comments as $comment)
            {
                array_push($comentarios[$id], $comment);
            }

            return new ViewModel(array('noticia' => $news, 'comentarios' => $comentarios[$id]));
        }
    }
    
    public function allAction()
    {   
        $nqb = $this->getEntityManager()->getRepository("Application\Entity\News")->createQueryBuilder('n');    
        $news = $nqb->select()->where('n.newsPublished = 1')->orderBy('n.newsDate', 'DESC')->getQuery()->getResult();
        return new ViewModel(array('news' => $news));
    }
    
    public function deleteAction()
    {
        $id = $this->params('id');
        $request = $this->getRequest();
        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\News")->createQueryBuilder('n');
            $news = $qb->select()->where('n.newsId = '.$id)->getQuery()->getResult();
        
            if(empty($news)) return $this->redirect()->toRoute('news');
            $news = $news[0];
            
            $this->getEntityManager()->remove($news);
            $this->getEntityManager()->flush();
             
            $this->flashMessenger()->addSuccessMessage("Notícia Apagada com sucesso: \"".$news->getNewsTitle()."\"");
            return $this->redirect()->toRoute('news');
        }
    }
}

