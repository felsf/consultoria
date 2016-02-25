<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Entity
 * @ORM\Table(name="email")
 */
class Email
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	**/
	private $emailId;

	/**
	* @ORM\Column(type="string")
	**/
	private $emailUsername;

	/**
	* @ORM\Column(type="string")
	**/
	private $emailPassword;

	/**
	* @ORM\Column(type="string")
	**/
	private $emailSmtp;


	public function setEmailUsername($username) {
		$this->emailUsername = $username;
	}

	public function setEmailPassword($password) {
		$this->emailPassword = $password;
	}

	public function setEmailSmtp($smtp) {
		$this->emailSmtp = $smtp;
	}

	public function getEmailUsername() {
		return $this->emailUsername;
	}

	public function getEmailPassword() {
		return $this->emailPassword;
	}

	public function getEmailSmtp() {
		return $this->emailSmtp;
	}

}