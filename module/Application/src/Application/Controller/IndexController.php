<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\News;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $qb = $this->getEntityManager()->getRepository("Application\Entity\Comment")->createQueryBuilder('c');        
        $nqb = $this->getEntityManager()->getRepository("Application\Entity\News")->createQueryBuilder('n');
        
        $comments = $qb->select()->orderBy('c.commentDate', 'DESC')->getQuery()->getResult();
        $news = $nqb->select()->where('n.newsPublished = 1')->orderBy('n.newsDate', 'DESC')->setMaxResults(3)->getQuery()->getResult();
        
        $comentarios = array();
        
        foreach($news as $noticia)
        {
            if(!array_key_exists($noticia->getNewsId(), $comentarios)) $comentarios[$noticia->getNewsId()] = array();
        }
        
        foreach($comments as $comment)
        {
            array_push($comentarios[$comment->getCommentNews()], $comment);
        }       
        
        $this->layout('layout/home_layout.phtml');
        return new ViewModel(array('news' => $news, 'comentarios' => $comentarios));
    }

    public function ajaxAction()
    {
    	$this->layout('layout/ajax_layout');
    	echo "Pergunta ID ".$this->params('id')." - Sua Resposta Foi: \"".$this->getRequest()->getPost('texto')."\"";
    	return new ViewModel();
    }
}
