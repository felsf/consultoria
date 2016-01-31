<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 *
 * @ORM\Table(name="request"), 
 * @ORM\Entity
 */
class Request
{
	/**
     * 
     *
     * @ORM\Column(name="request_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $requestId;

	/**
     * 
     *
     * @ORM\Column(name="request_email", type="string", length=40, nullable=false)
    **/
	protected $requestEmail;

	/**
     * 
     *
     * @ORM\Column(name="request_content", type="text", nullable=false)
    **/
	protected $requestContent;

	/**
	* @ORM\Column(type="boolean", options={"default"=0}, nullable=true)
	**/
	protected $requestRead;

		public function getRequestId(){
		return $this->requestId;
	}

	public function setRequestId($requestId){
		$this->requestId = $requestId;
	}

	public function getRequestEmail(){
		return $this->requestEmail;
	}

	public function setRequestEmail($requestEmail){
		$this->requestEmail = $requestEmail;
	}

	public function getRequestContent(){
		return $this->requestContent;
	}

	public function setRequestContent($requestContent){
		$this->requestContent = $requestContent;
	}
}