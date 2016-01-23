<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="user_login_UNIQUE", columns={"user_login"}), @ORM\UniqueConstraint(name="user_email_UNIQUE", columns={"user_email"})})
 * @ORM\Entity
 */
class User implements InputFilterAwareInterface
{
    private $inputFilter;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_login", type="string", length=25, nullable=false)
     */
    private $userLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=45, nullable=false)
     */
    private $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=45, nullable=false)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=255, nullable=false)
     */
    private $userPassword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_register_date", type="datetime", nullable=false)
     */
    private $userRegisterDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_last_login", type="datetime", nullable=true)
     */
    private $userLastLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="user_ip", type="string", length=45, nullable=false)
     */
    private $userIp;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_profile", type="integer", nullable=true)
     */
    private $userProfile = '1';
    /**
     * @return the $userId
     */
    
    //---------------------------------------------------------------------------------//  
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        $this->inputFilter = $inputFilter;
    }
    
    public function getInputFilter()
    {
        if($this->inputFilter == null)
        {
            $inputFilter = new InputFilter();
            $inputFilter->add(array('name' => 'user_login', 'required' => true, 'validators' => array(array('name' => 'StringLength', 'options' => array('min' => 6, 'max' => 20)))));
            $inputFilter->add(array('name' => 'user_name', 'required' => true, 'validators' => array(array('name' => 'StringLength', 'options' => array('min' => 6, 'max' => 45)))));
            $inputFilter->add(array('name' => 'user_password', 'required' => true, 'validators' => array(array('name' => 'StringLength', 'options' => array('min' => 6, 'max' => 25)))));
            $inputFilter->add(array('name' => 'user_email', 'required' => true));
            
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }
    
    public function getUserId()
    {
        return $this->userId;
    }

 /**
     * @return the $userLogin
     */
    public function getUserLogin()
    {
        return $this->userLogin;
    }

 /**
     * @return the $userEmail
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

 /**
     * @return the $userName
     */
    public function getUserName()
    {
        return $this->userName;
    }

 /**
     * @return the $userPassword
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

 /**
     * @return the $userRegisterDate
     */
    public function getUserRegisterDate()
    {
        return $this->userRegisterDate;
    }

 /**
     * @return the $userLastLogin
     */
    public function getUserLastLogin()
    {
        return $this->userLastLogin;
    }

 /**
     * @return the $userIp
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

 /**
     * @return the $userProfile
     */
    public function getUserProfile()
    {
        return $this->userProfile;
    }

 /**
     * @param number $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

 /**
     * @param string $userLogin
     */
    public function setUserLogin($userLogin)
    {
        $this->userLogin = $userLogin;
    }

 /**
     * @param string $userEmail
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }

 /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

 /**
     * @param string $userPassword
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;
    }

 /**
     * @param DateTime $userRegisterDate
     */
    public function setUserRegisterDate($userRegisterDate)
    {
        $this->userRegisterDate = $userRegisterDate;
    }

 /**
     * @param DateTime $userLastLogin
     */
    public function setUserLastLogin($userLastLogin)
    {
        $this->userLastLogin = $userLastLogin;
    }

 /**
     * @param string $userIp
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;
    }

 /**
     * @param number $userProfile
     */
    public function setUserProfile($userProfile)
    {
        $this->userProfile = $userProfile;
    }



}

