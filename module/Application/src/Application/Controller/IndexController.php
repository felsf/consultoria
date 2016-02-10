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
use Application\Entity\Request;

class IndexController extends AbstractActionController
{
    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        return parent::onDispatch($e);    
    }

    public function indexAction()
    {
        $qb = $this->getEntityManager()->getRepository("Application\Entity\Comment")->createQueryBuilder('c');                
        $nqb = $this->getEntityManager()->getRepository("Application\Entity\News")->createQueryBuilder('n');

        $comentarios = $qb->select()->orderBy('c.commentDate', 'DESC')->getQuery()->getResult();                
        $images = $this->getEntityManager()->getRepository("Application\Entity\Image")->createQueryBuilder('i')->select()->where('i.imageActive = 1')->orderBy('i.imageId', 'ASC')->getQuery()->getResult();           
        $news = $nqb->select()->where('n.newsPublished = 1')->orderBy('n.newsDate', 'DESC')->setMaxResults(3)->getQuery()->getResult();

        $this->layout('layout/home_layout.phtml');
        $this->layout()->images = $images;
        
        return new ViewModel(array('news' => $news, 'comentarios' => $comentarios, 'images' => $images));
    }

      
}
