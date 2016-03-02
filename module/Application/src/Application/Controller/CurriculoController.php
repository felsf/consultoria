<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Curriculo;

class CurriculoController extends AbstractActionController
{
	public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $logged_block = array('index');        
        if(!$this->identity() && !in_array($e->getRouteMatch()->getParam("action"), $logged_block)) return $this->redirect()->toRoute('home');

        $qb = $this->getEntityManager()->getRepository("Application\Entity\Curriculo")->createQueryBuilder('c');
        $curriculo = $qb->select()->getQuery()->getResult();

        if(empty($curriculo)) {
            $curriculo = new Curriculo();
            $this->getEntityManager()->persist($curriculo);
            $this->getEntityManager()->flush();
        }

        return parent::onDispatch($e);              
    }

    public function indexAction()
    {
        $qb = $this->getEntityManager()->getRepository("Application\Entity\Curriculo")->createQueryBuilder('c');
        $curriculo = $qb->select()->getQuery()->getResult();
        $curriculo = $curriculo[0];
        return new ViewModel(array('curriculo' => $curriculo));
    }

    public function editAction()
    {
    	$request = $this->getRequest();
        
        $qb = $this->getEntityManager()->getRepository("Application\Entity\Curriculo")->createQueryBuilder('c');
        $curriculo = $qb->select()->getQuery()->getResult();
        $curriculo = $curriculo[0];

        if($request->isPost())
        {
            $curriculo->setCurriculoContent(htmlspecialchars($request->getPost("curriculo-content")));
            $this->getEntityManager()->persist($curriculo);
            $this->getEntityManager()->flush();

            $this->flashMessenger()->addSuccessMessage("Currículo salvo com sucesso.");
            return $this->redirect()->toRoute('curriculo-edit');
        }

        return new ViewModel(array('curriculo' => $curriculo));
    }


}

