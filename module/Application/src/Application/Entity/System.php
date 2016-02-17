<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="system_controller")
**/ 
class System
{
	/**
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	* @ORM\Column(type="integer")
	**/
	private $infoId;

	/**
	* @ORM\Column(type="string")
	**/
	private $infoDescription;

	/**
	* @ORM\Column(type="string")
	**/
	private $infoContent;


	public function getInfoId(){
		return $this->infoId;
	}

	public function setInfoId($infoId){
		$this->infoId = $infoId;
	}

	public function getInfoDescription(){
		return $this->infoDescription;
	}

	public function setInfoDescription($infoDescription){
		$this->infoDescription = $infoDescription;
	}

	public function getInfoContent(){
		return $this->infoContent;
	}

	public function setInfoContent($infoContent){
		$this->infoContent = $infoContent;
	}
}