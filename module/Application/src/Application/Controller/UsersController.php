<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

use Application\Form\UserRegisterForm;
use Application\Form\UserLoginForm;

use Application\Entity\User;


class UsersController extends AbstractActionController
{
    public function onDispatch(MvcEvent $e)
    {
        $logged_block = array('login', 'register');        
       // if($this->identity() && in_array($e->getRouteMatch()->getParam("action"), $logged_block)) return $this->redirect()->toRoute('home');
        return parent::onDispatch($e);              
    }

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
            $user->setUserIp($_SERVER['REMOTE_ADDR']);
            $user->setUserRegisterDate(new \DateTime('now'));
            
            $userRegisterForm->setInputFilter($user->getInputFilter());
            $userRegisterForm->setData($request->getPost());
            
            if($userRegisterForm->isValid())
            {            
                $this->getEntityManager()->persist($user);
                $this->getEntityManager()->flush();            
                $this->flashMessenger()->addInfoMessage("Seu cadastrado foi realizado com sucesso, ".$request->getPost('user_name'));
                return $this->redirect()->toRoute('home');
            }
            
            $this->flashMessenger()->addFlashMessage("Falha no Cadastro.");
            $this->redirect()->toRoute('users-login');
            
        }
        
        return new ViewModel(array('userRegisterForm' => $userRegisterForm));
    }
    
    public function loginAction()
    {
        $loginForm = new UserLoginForm();
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $authService = $this->getServiceLocator()->get('doctrine.authenticationservice.orm_default');
            $adapter = $authService->getAdapter();
            $adapter->setIdentityValue($request->getPost('user_login'));
            $adapter->setCredentialValue(md5($request->getPost('user_password')));
        
            $success = $authService->authenticate();
        
            if($success->isValid()) {
                $this->flashMessenger()->addSuccessMessage("Autenticado com sucesso!");
                $this->redirect()->toRoute('home');
            }
        
            else {
                $this->flashMessenger()->addErrorMessage("Usuário ou Senha inválidos!");
                $this->redirect()->toRoute('users-login');
            }
        
        }
        
        return new ViewModel(array('loginForm' => $loginForm));
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

