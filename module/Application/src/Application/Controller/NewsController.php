<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Form\NewsCreateForm;

class NewsController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function createAction()
    {
        $newsForm = new NewsCreateForm();
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            if(isset($request->getPost()['btn-publish'])) // Publica Diretamente
            {
                
            }
            
            elseif(isset($request->getPost()['btn-save'])) // Salve como Rascunho.
            {
                
            }
        }
        
        return new ViewModel(array('newsForm' => $newsForm));
    }
}

