<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

use Application\Form\UserRegisterForm;
use Application\Form\UserEditForm;
use Application\Form\UserLoginForm;

use Application\Entity\User;


class UsersController extends AbstractActionController
{
    public function onDispatch(MvcEvent $e)
    {
        $logged_block = array('login', 'register');        
        if(!$this->identity() && !in_array($e->getRouteMatch()->getParam("action"), $logged_block)) return $this->redirect()->toRoute('home');
        return parent::onDispatch($e);              
    }

    public function indexAction()
    {              
        return new ViewModel(array('users' => $this->getEntityManager()->getRepository("Application\Entity\User")->createQueryBuilder('u')->select()->orderBy('u.userId', 'ASC')->getQuery()->getResult()));
    }
    
    public function editAction()
    {
        $request = $this->getRequest();
        $editForm = new UserEditForm();        
        $id = $this->params('id');
        $qb = $this->getEntityManager()->getRepository("Application\Entity\User")->createQueryBuilder('u');
        
        if(isset($id))
        {
            $user = $qb->select()->where("u.userId = ".$id)->getQuery()->getResult();
            $user = $user[0];
            $editForm = new UserEditForm();
            
            if(empty($user)) return $this->redirect()->toRoute('users');
            
            if($request->isPost())
            {                
                $user->setUserLogin($request->getPost('user_login'));
                $user->setUserName($request->getPost('user_name'));
                $user->setUserEmail($request->getPost('user_email'));                
                $user->setUserIp($request->getPost('user_ip'));                              
                $user->setUserPassword( empty($request->getPost('user_password')) ? $user->getUserPassword() : md5($request->getPost('user_password')));                
                $user->setUserProfile($request->getPost('user_profile'));
                
                $this->getEntityManager()->persist($user);
                $this->getEntityManager()->flush();
                $this->flashMessenger()->addInfoMessage("Cadastrado atualizado com sucesso, Usuário: ".$request->getPost('user_name'));            
                
                $this->redirect()->toRoute('users');
            
            }
            
            return new ViewModel(array('editForm' => $editForm, 'user' => $user, 'profiles' => $this->profiles));
        }
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
            $user->setUserProfile(1);
            
            $userRegisterForm->setInputFilter($user->getInputFilter());
            $userRegisterForm->setData($request->getPost());
            
            if($userRegisterForm->isValid())
            {            
                $this->getEntityManager()->persist($user);
                $this->getEntityManager()->flush();            
                $this->flashMessenger()->addInfoMessage("Seu cadastrado foi realizado com sucesso, ".$request->getPost('user_name'));
                return $this->redirect()->toRoute('users-login');
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
                $qb = $this->getEntityManager()->getRepository("Application\Entity\User")->createQueryBuilder('u');
                $user = $qb->select()->where("u.userLogin = '".$request->getPost('user_login')."'")->getQuery()->getResult();
                $user = $user[0];
                
                $user->setUserLastLogin(new \DateTime('now'));
                $user->setUserIp($_SERVER['REMOTE_ADDR']);
                
                $this->getEntityManager()->persist($user);
                $this->getEntityManager()->flush();
                
                $this->flashMessenger()->addSuccessMessage("Autenticado com sucesso!");
                return $this->redirect()->toRoute('home');
            }
        
            else {
                $this->flashMessenger()->addErrorMessage("Usuário ou Senha inválidos!");
                return $this->redirect()->toRoute('users-login');
            }
        
        }
        
        return new ViewModel(array('loginForm' => $loginForm));
    }
    
    public function logoutAction()
    {
        if($this->identity())
        {
            $this->getServiceLocator()->get('doctrine.authenticationservice.orm_default')->getStorage()->clear();
            $this->flashMessenger()->addSuccessMessage("Você saiu!");
        }
        
        return $this->redirect()->toRoute('home');
    }
    
    public function deleteAction()
    {
        $request = $this->getRequest();
        $id = $this->params('id');
        $qb = $this->getEntityManager()->getRepository("Application\Entity\User")->createQueryBuilder('u');
        
        if(isset($id))
        {
           $user = $qb->select()->where("u.userId = ".$id)->getQuery()->getResult();
           $user = $user[0];
           if(empty($user)) return $this->redirect()->toRoute('users');

           $this->getEntityManager()->remove($user);
           $this->getEntityManager()->flush();
           
           $this->flashMessenger()->addSuccessMessage("Usuário Apagado com sucesso: \"".$user->getUserName()."\"");
           $this->redirect()->toRoute('users');
           
           return new ViewModel(array('user' => $user));
        }       
    }
    
    public function blockAction()
    {
        $request = $this->getRequest();
        $id = $this->params('id');
        $qb = $this->getEntityManager()->getRepository("Application\Entity\User")->createQueryBuilder('u');
        
        if(isset($id))
        {
           $user = $qb->select()->where("u.userId = ".$id)->getQuery()->getResult();
           $user = $user[0];
           if(empty($user) || $user->isUserBlocked()) return $this->redirect()->toRoute('users');
           else $user->setUserBlocked(true);
           
           $this->getEntityManager()->persist($user);
           $this->getEntityManager()->flush();
           
           $this->flashMessenger()->addSuccessMessage("Usuário Bloqueado com sucesso: \"".$user->getUserName()."\"");
           $this->redirect()->toRoute('users');
           
           return new ViewModel(array('user' => $user));
        }       
    }
    
    public function unblockAction()
    {
        $request = $this->getRequest();
        $id = $this->params('id');
        $qb = $this->getEntityManager()->getRepository("Application\Entity\User")->createQueryBuilder('u');
        
        if(isset($id))
        {
           $user = $qb->select()->where("u.userId = ".$id)->getQuery()->getResult();
           $user = $user[0];
           if(empty($user) || !$user->isUserBlocked()) return $this->redirect()->toRoute('users');
           else $user->setUserBlocked(false);
           
           $this->getEntityManager()->persist($user);
           $this->getEntityManager()->flush();
           
           $this->flashMessenger()->addSuccessMessage("Usuário Desbloqueado com sucesso: \"".$user->getUserName()."\"");
           $this->redirect()->toRoute('users');
           
           return new ViewModel(array('user' => $user));
        }
    }
}

