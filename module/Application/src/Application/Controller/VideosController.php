<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Video;

class VideosController extends AbstractActionController
{
    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $logged_block = array('index');        
        if(!$this->identity() && !in_array($e->getRouteMatch()->getParam("action"), $logged_block)) return $this->redirect()->toRoute('home');
        return parent::onDispatch($e);
    }

    public function indexAction()
    {
    	$qb = $this->getEntityManager()->getRepository("Application\Entity\Video")->createQueryBuilder('v');
    	$videos = $qb->select()->where("v.videoToggle = 1")->orderBy('v.videoId', 'ASC')->getQuery()->getResult();
    	return new ViewModel(array('videos' => $videos));
        return new ViewModel();
    }

    public function listAction()
    {
    	$qb = $this->getEntityManager()->getRepository("Application\Entity\Video")->createQueryBuilder('v');
    	$videos = $qb->select()->orderBy('v.videoId', 'ASC')->getQuery()->getResult();
    	return new ViewModel(array('videos' => $videos));
    }

    public function addAction()
    {
    	$request = $this->getRequest();
    	if($request->isPost())
    	{
    		$video = new Video();
    		$video->setVideoTitle($request->getPost('video_title'));
    		$video->setVideoUrl($request->getPost('video_url'));
    		$video->setVideoToggle(1);

    		$this->getEntityManager()->persist($video);
    		$this->getEntityManager()->flush();

    		$this->flashMessenger()->addSuccessMessage("Vídeo ".$request->getPost('video_title').' adicionado com sucesso!');
    		return $this->redirect()->toRoute('videos-list');
    	}

    	return new ViewModel();
    }

    public function deleteAction()
    {
    	$id = $this->params('id');
        $request = $this->getRequest();        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Video")->createQueryBuilder('v');
            $video = $qb->select()->where('v.videoId = '.$id)->getQuery()->getResult();
        
            if(empty($video)) return $this->redirect()->toRoute('videos-list');
            $video = $video[0];

            $this->getEntityManager()->remove($video);
            $this->getEntityManager()->flush();
            return $this->redirect()->toRoute("videos-list");
        }

    	return new ViewModel();
    }

    public function toggleAction()
    {
    	$id = $this->params('id');
        $request = $this->getRequest();        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Video")->createQueryBuilder('v');
            $video = $qb->select()->where('v.videoId = '.$id)->getQuery()->getResult();
        
            if(empty($video)) return $this->redirect()->toRoute('videos-list');
            $video = $video[0];

            $video->setVideoToggle(!$video->getVideoToggle());
            $this->getEntityManager()->persist($video);
            $this->getEntityManager()->flush();
            return $this->redirect()->toRoute("videos-list");
        }

    	return new ViewModel();
    }


}

