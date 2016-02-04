<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Request;

class RequestsController extends AbstractActionController
{
	public function onDispatch(\Zend\Mvc\MvcEvent $e)
	{
		return parent::onDispatch($e);
	}

    public function indexAction()
    {
    	$qb = $this->getEntityManager()->getRepository("Application\Entity\Request")->createQueryBuilder('r');
    	$requests = $qb->select()->orderBy("r.requestRead", 'ASC')->getQuery()->getResult();
        return new ViewModel(array('requests' => $requests));
    }


    public function addAction()
    {
    	$request = $this->getRequest();

        if($request->isPost())
        {
            $req = new Request();
            $req->setRequestEmail($request->getPost('request_email'));
            $req->setRequestContent($request->getPost('request_content'));
            $req->setRequestRead(0);

            $this->getEntityManager()->persist($req);
            $this->getEntityManager()->flush();

            $this->flashMessenger()->addSuccessMessage("Solicitação registrada com sucesso. O consultor entrará em contato em breve!");
            return $this->redirect()->toRoute('application');

        }

        return new ViewModel(array());
    }

    public function readAction()
    {
    	$id = $this->params('id');
        $request = $this->getRequest();
        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Request")->createQueryBuilder('r');
            $request = $qb->select()->where('r.requestId = '.$id)->getQuery()->getResult();
        
            if(empty($request)) return $this->redirect()->toRoute('requests');
            $request = $request[0];

            $request->setRequestRead(1);
            $this->getEntityManager()->persist($request);
            $this->getEntityManager()->flush();

            $this->flashMessenger()->addSuccessMessage("Requisição ID $id marcada como lida!");
        }

    	return $this->redirect()->toRoute("requests");
    }

}

