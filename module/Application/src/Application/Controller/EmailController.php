<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Email;

class EmailController extends AbstractActionController
{
	public function onDispatch(\Zend\Mvc\MvcEvent $e) {
		$logged_block = array();        
        if(!$this->identity() && !in_array($e->getRouteMatch()->getParam("action"), $logged_block)) return $this->redirect()->toRoute('home');
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

		return parent::onDispatch($e);
	}

	public function editAction()
	{
		$qb = $this->getEntityManager()->getRepository("Application\Entity\Email")->createQueryBuilder('e');
		$emails = $qb->select()->getQuery()->getResult();
		$email = $emails[0];

		$request = $this->getRequest();

		if($request->isPost()) {
			$email->setEmailUsername($request->getPost('email_username'));
			$email->setEmailPassword($request->getPost('email_password'));
			$email->setEmailSmtp($request->getPost('email_smtp'));

			$this->getEntityManager()->persist($email);
			$this->getEntityManager()->flush();

			$this->flashMessenger()->addSuccessMessage("Email atualizado com sucesso!");
			return $this->redirect()->toRoute('email');
		}

		return new ViewModel(array('email' => $email));
	}
}