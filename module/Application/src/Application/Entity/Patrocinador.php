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


}

