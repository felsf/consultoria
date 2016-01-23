<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Form\UserRegisterForm;

use Application\Entity\User;

class UsersController extends AbstractActionController
{

    public function indexAction()
    {              
        return new ViewModel();
    }
    
    public function editAction()
    {
        $request = $this->getRequest();
        return new ViewModel();
    }
    
    public function registerAction() //$this->flashMessenger()->addSuccessMessage("Message");
    {
        $request = $this->getRequest();        
        $userRegisterForm = new UserRegisterForm();
        if($request->isPost())
        {
            $user = new User();
            $user->setUserLogin($request->getPost('user_login'));
            $user->setUserName($request->getPost('user_name'));
            $user->setUserEmail($request->getPost('user_email'));
            $user->setUserPassword(md5($request->getPost('user_password')));
            
            $userRegisterForm->setInputFilter($user->getInputFilter());
            $userRegisterForm->setData($request->getPost());
            
            if($userRegisterForm->isValid())
            {            
                //$this->getEntityManager()->persist($user);
                //$this->getEntityManager()->flush();
            
                $this->flashMessenger()->addInfoMessage("Seu cadastrado foi realizado com sucesso, ".$request->getPost('user_name'));
                //return $this->redirect()->toRoute('home');
            }                        
        }
        
        return new ViewModel(array('userRegisterForm' => $userRegisterForm));
    }
    
    public function loginAction()
    {
        $request = $this->getRequest();
        return new ViewModel();
    }
    
    public function deleteAction()
    {
        $request = $this->getRequest();
        return new ViewModel();
    }
    
    public function blockAction()
    {
        $request = $this->getRequest();
        return new ViewModel();
    }
    
    public function unblockAction()
    {
        $request = $this->getRequest();
        return new ViewModel();
    }


}

