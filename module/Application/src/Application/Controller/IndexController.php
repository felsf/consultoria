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
        $qb = $this->getEntityManager()->getRepository("Application\Entity\News")->createQueryBuilder('n');
        $news = $qb->select()->where('n.newsPublished = 1')->orderBy('n.newsDate', 'DESC')->setMaxResults(3)->getQuery()->getResult();
        $this->layout('layout/home_layout.phtml');
        return new ViewModel(array('news' => $news));
    }

    public function ajaxAction()
    {
    	$this->layout('layout/ajax_layout');
    	echo "Pergunta ID ".$this->params('id')." - Sua Resposta Foi: \"".$this->getRequest()->getPost('texto')."\"";
    	return new ViewModel();
    }
}
