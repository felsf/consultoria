<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CurriculoController extends AbstractActionController
{
	public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $logged_block = array('index');        
        if(!$this->identity() && !in_array($e->getRouteMatch()->getParam("action"), $logged_block)) return $this->redirect()->toRoute('home');
        return parent::onDispatch($e);              
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function editAction()
    {
    	$qb = $this->getEntityManager()->getRepository("Application\Entity\Email")->createQueryBuilder('e');
		$emails = $qb->select()->getQuery()->getResult();

		if(empty($emails)) {
			$email = new Email();
			$email->setEmailUsername("teste@live.com");
			$email->setEmailPassword("teste");
			$email->setEmailSmtp("smtp.teste.com");

			$this->getEntityManager()->Persist($email);
			$this->getEntityManager()->flush();
		}
        return new ViewModel();
    }


}

