<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Patrocinador
 *
 * @ORM\Table(name="patrocinador", uniqueConstraints={@ORM\UniqueConstraint(name="patrocinador_position_UNIQUE", columns={"patrocinador_position"})})
 * @ORM\Entity
 */
class Patrocinador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="patrocinador_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $patrocinadorId;

    /**
     * @var string
     *
     * @ORM\Column(name="patrocinador_name", type="string", length=100, nullable=false)
     */
    private $patrocinadorName;

    /**
     * @var string
     *
     * @ORM\Column(name="patrocinador_image", type="string", length=255, nullable=false)
     */
    private $patrocinadorImage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="patrocinador_active", type="boolean", nullable=false)
     */
    private $patrocinadorActive = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="patrocinador_position", type="integer", nullable=false)
     */
    private $patrocinadorPosition;
 /**
     * @return the $patrocinadorId
     */
    public function getPatrocinadorId()
    {
        return $this->patrocinadorId;
    }

 /**
     * @return the $patrocinadorName
     */
    public function getPatrocinadorName()
    {
        return $this->patrocinadorName;
    }

 /**
     * @return the $patrocinadorImage
     */
    public function getPatrocinadorImage()
    {
        return $this->patrocinadorImage;
    }

 /**
     * @return the $patrocinadorActive
     */
    public function getPatrocinadorActive()
    {
        return $this->patrocinadorActive;
    }

 /**
     * @return the $patrocinadorPosition
     */
    public function getPatrocinadorPosition()
    {
        return $this->patrocinadorPosition;
    }

 /**
     * @param number $patrocinadorId
     */
    public function setPatrocinadorId($patrocinadorId)
    {
        $this->patrocinadorId = $patrocinadorId;
    }

 /**
     * @param string $patrocinadorName
     */
    public function setPatrocinadorName($patrocinadorName)
    {
        $this->patrocinadorName = $patrocinadorName;
    }

 /**
     * @param string $patrocinadorImage
     */
    public function setPatrocinadorImage($patrocinadorImage)
    {
        $this->patrocinadorImage = $patrocinadorImage;
    }

 /**
     * @param boolean $patrocinadorActive
     */
    public function setPatrocinadorActive($patrocinadorActive)
    {
        $this->patrocinadorActive = $patrocinadorActive;
    }

 /**
     * @param number $patrocinadorPosition
     */
    public function setPatrocinadorPosition($patrocinadorPosition)
    {
        $this->patrocinadorPosition = $patrocinadorPosition;
    }



}

