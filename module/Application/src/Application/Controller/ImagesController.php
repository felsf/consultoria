<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Image;

class ImagesController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
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

    public function galleryAction()
    {
    	return new ViewModel();
    }


}

