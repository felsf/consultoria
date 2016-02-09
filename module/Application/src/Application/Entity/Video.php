<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
**/
class Video 
{
	/**
	 * @ORM\Column(name="video_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	private $videoId;

	/**
	* @ORM\Column(name="video_title", type="string", nullable=false)
	**/
	private $videoTitle;

	/**
	* @ORM\Column(name="video_url", type="string", nullable=false)
	**/
	private $videoUrl;

	/**
	* @ORM\Column(name="video_toggle", type="boolean", nullable=false, options={"default"=1})
	**/
	private $videoToggle;


	//--------------------------------------------------------------------------------//

	public function getVideoId(){
		return $this->videoId;
	}

	public function setVideoId($videoId){
		$this->videoId = $videoId;
	}

	public function getVideoTitle(){
		return $this->videoTitle;
	}

	public function setVideoTitle($videoTitle){
		$this->videoTitle = $videoTitle;
	}

	public function getVideoUrl(){
		return $this->videoUrl;
	}

	public function setVideoUrl($videoUrl){
		$this->videoUrl = $videoUrl;
	}

	public function getVideoToggle(){
		return $this->videoToggle;
	}

	public function setVideoToggle($videoToggle){
		$this->videoToggle = $videoToggle;
	}
}