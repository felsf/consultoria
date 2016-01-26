<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Patrocinador;

class PatrocinadoresController extends AbstractActionController
{
	public function onDispatch(\Zend\Mvc\MvcEvent $e)
	{
		$logged_block = array();
        if(!$this->identity() && !in_array($e->getRouteMatch()->getParam("action"), $logged_block)) return $this->redirect()->toRoute('home');        
		return parent::onDispatch($e);
	}

    public function indexAction()
    {
    	$qb = $this->getEntityManager()->getRepository("Application\Entity\Patrocinador")->createQueryBuilder('p');
    	$patrocinadores = $qb->select()->orderBy('p.patrocinadorId', 'ASC')->getQuery()->getResult();
        return new ViewModel(array('patrocinadores' => $patrocinadores));
    }

    public function editAction()
    {
    	$id = $this->params('id');
        $request = $this->getRequest();        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Patrocinador")->createQueryBuilder('p');
            $patrocinadores = $qb->select()->where('p.patrocinadorId = '.$id)->getQuery()->getResult();
        
            if(empty($patrocinadores)) return $this->redirect()->toRoute('patrocinadores');
            $ptr = $patrocinadores[0];
    		
    		$qb = $this->getEntityManager()->getRepository("Application\Entity\Patrocinador")->createQueryBuilder('p');
    		$patrocinadores = $qb->select()->where('p.patrocinadorPosition != '.$ptr->getPatrocinadorPosition())->orderBy('p.patrocinadorId', 'ASC')->getQuery()->getResult();

    		if($request->isPost())
    		{
    			try
    			{
	    			$ptr->setPatrocinadorName($request->getPost('patrocinador_name'));
	    			$ptr->setPatrocinadorPosition($request->getPost('patrocinador_position'));	    			
					$this->getEntityManager()->persist($ptr);
					$this->getEntityManager()->flush();
					$this->flashMessenger()->addSuccessMessage("Patrocinador atualizado com sucesso!");
					return $this->redirect()->toRoute('patrocinadores');
				}
				catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e)
				{
					$this->flashMessenger()->addErrorMessage("Falha ao atualizar patrocinador. Posição já ocupada!");
					return $this->redirect()->toRoute('patrocinadores-edit', array('id' => $ptr->getPatrocinadorId()));
				}			
    		}

    		return new ViewModel(array('patrocinadores' => $patrocinadores, 'patrocinador' => $ptr));
    	}
    }

    public function addAction()
    {
    	$request = $this->getRequest();

    	if($request->isPost())
    	{
    		$dir = './public/img/patrocinadores/';    		
    		if (!file_exists($dir)) mkdir($dir, 0777, true);

			$file = $dir . basename($_FILES["patrocinador_url"]["name"]);
			$imageFileType = pathinfo($file,PATHINFO_EXTENSION);

			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) 
			{
    			$this->flashMessenger()->addErrorMessage("Somente imagens são permitidas!");
    			return $this->redirect()->toRoute('patrocinaores-add');
			}

			$qb = $this->getEntityManager()->getRepository('Application\Entity\Patrocinador')->createQueryBuilder('p');
			$patrocinadores = $qb->select()->orderBy('p.patrocinadorPosition')->getQuery()->getResult();

			$ptr = new Patrocinador();
			$ptr->setPatrocinadorName($request->getPost('patrocinador_name'));
			$ptr->setPatrocinadorImage("patrocinadores/".basename($_FILES["patrocinador_url"]["name"]));
			$ptr->setPatrocinadorActive(1);
			$ptr->setPatrocinadorPosition( empty($patrocinadores) ? 1 : $patrocinadores[count($patrocinadores) - 1]->getPatrocinadorPosition() + 1);

			if(move_uploaded_file($_FILES["patrocinador_url"]["tmp_name"], $file))
			{
				$this->flashMessenger()->addSuccessMessage("Patrocinador cadastrado com sucesso!");
				$this->getEntityManager()->persist($ptr);
				$this->getEntityManager()->flush();
				return $this->redirect()->toRoute('patrocinadores');
			}
			else {
				$this->flashMessenger()->addErrorMessage("O upload falhou!");
				return $this->redirect()->toRoute('patrocinadores-add');
			}
    	}

        return new ViewModel();
    }

    public function toggleAction()
    {
    	$id = $this->params('id');
        $request = $this->getRequest();        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Patrocinador")->createQueryBuilder('p');
            $patrocinadores = $qb->select()->where('p.patrocinadorId = '.$id)->getQuery()->getResult();
        
            if(empty($patrocinadores)) return $this->redirect()->toRoute('patrocinadores');
            $ptr = $patrocinadores[0];

            $ptr->setPatrocinadorActive(!$ptr->getPatrocinadorActive());

            $this->flashMessenger()->addInfoMessage("Patrocinador ".($ptr->getPatrocinadorActive() ? 'habilitado' : 'desabilitado').' com sucesso!');

            $this->getEntityManager()->persist($ptr);
            $this->getEntityManager()->flush();

            return $this->redirect()->toRoute('patrocinadores');
        }
    	return new ViewModel();
    }

    public function deleteAction()
    {
    	$id = $this->params('id');
        $request = $this->getRequest();        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Patrocinador")->createQueryBuilder('p');
            $patrocinadores = $qb->select()->where('p.patrocinadorId = '.$id)->getQuery()->getResult();
        
            if(empty($patrocinadores)) return $this->redirect()->toRoute('patrocinadores');
            $ptr = $patrocinadores[0];

            $this->getEntityManager()->remove($ptr);
            $this->getEntityManager()->flush();

            $this->flashMessenger()->addErrorMessage("Patrocinador apagado com sucesso: ".$ptr->getPatrocinadorName()."!");          

            return $this->redirect()->toRoute('patrocinadores');
        }

    	return new ViewModel();
    }
}

