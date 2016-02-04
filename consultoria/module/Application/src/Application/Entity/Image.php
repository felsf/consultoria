<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity
 */
class Image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="image_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $imageId;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url", type="string", length=255, nullable=false)
     */
    private $imageUrl;

    /**
     * @var boolean
     *
     * @ORM\Column(name="image_active", type="boolean", nullable=false)
     */
    private $imageActive = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="image_title", type="string", length=100, nullable=true)
     */
    private $imageTitle;


    // ------------------------------------------ //

    public function getImageId(){
        return $this->imageId;
    }

    public function setImageId($imageId){
        $this->imageId = $imageId;
    }

    public function getImageUrl(){
        return $this->imageUrl;
    }

    public function setImageUrl($imageUrl){
        $this->imageUrl = $imageUrl;
    }

    public function getImageActive(){
        return $this->imageActive;
    }

    public function setImageActive($imageActive){
        $this->imageActive = $imageActive;
    }

    public function getImageTitle(){
        return $this->imageTitle;
    }

    public function setImageTitle($imageTitle){
        $this->imageTitle = $imageTitle;
    }

}