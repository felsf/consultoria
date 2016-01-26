<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Image;

use Zend\Mvc\MvcEvent;

class ImagesController extends AbstractActionController
{
	public function onDispatch(MvcEvent $e)
	{
		$logged_block = array('gallery');        
        if(!$this->identity() && !in_array($e->getRouteMatch()->getParam("action"), $logged_block)) return $this->redirect()->toRoute('home');
		return parent::onDispatch($e);
	}

    public function indexAction()
    {
    	$qb = $this->getEntityManager()->getRepository("Application\Entity\Image")->createQueryBuilder('i');
    	$images = $qb->select()->orderBy('i.imageId', 'ASC')->getQuery()->getResult();
        return new ViewModel(array('images' => $images));
    }

    public function addAction()
    {
    	$request = $this->getRequest();

    	if($request->isPost())
    	{
    		$dir = './public/img/galeria/';    		
    		if (!file_exists($dir)) mkdir($dir, 0777, true);

			$file = $dir . basename($_FILES["image_url"]["name"]);
			$imageFileType = pathinfo($file,PATHINFO_EXTENSION);

			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) 
			{
    			$this->flashMessenger()->addErrorMessage("Somente imagens são permitidas!");
    			return $this->redirect()->toRoute('images-add');
			}

			$img = new Image();
			$img->setImageTitle($request->getPost('image_title'));
			$img->setImageUrl("galeria/".basename($_FILES["image_url"]["name"]));
			$img->setImageActive(1);			

			if(move_uploaded_file($_FILES["image_url"]["tmp_name"], $file))
			{
				$this->flashMessenger()->addSuccessMessage("Imagem postada com sucesso!");
				$this->getEntityManager()->persist($img);
				$this->getEntityManager()->flush();
				return $this->redirect()->toRoute('images');
			}
			else {
				$this->flashMessenger()->addErrorMessage("O upload falhou!");
				return $this->redirect()->toRoute('images-add');
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
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Image")->createQueryBuilder('i');
            $image = $qb->select()->where('i.imageId = '.$id)->getQuery()->getResult();
        
            if(empty($image)) return $this->redirect()->toRoute('images');
            $image = $image[0];

            $image->setImageActive(!$image->getImageActive());

            $this->flashMessenger()->addInfoMessage("Imagem ".($image->getImageActive() ? 'habilitada' : 'desabilitada').' com sucesso!');

            $this->getEntityManager()->persist($image);
            $this->getEntityManager()->flush();

            return $this->redirect()->toRoute('images');
        }
    }

    public function deleteAction()
    {
    	$id = $this->params('id');
        $request = $this->getRequest();    

        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Image")->createQueryBuilder('i');
            $image = $qb->select()->where('i.imageId = '.$id)->getQuery()->getResult();
        
            if(empty($image)) return $this->redirect()->toRoute('images');
            $image = $image[0];

            $this->getEntityManager()->remove($image);
            $this->getEntityManager()->flush();

            $this->flashMessenger()->addErrorMessage("Imagem \"".$image->getImageTitle()."\" apagada com sucesso!");
            return $this->redirect()->toRoute('images');
        }
    }

    public function galleryAction()
    {
    	return new ViewModel();
    }


}

