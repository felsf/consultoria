<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Entity
 * @ORM\Table(name="chat")
 */
class Chat
{
    /**
     * 
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=false)
     */
    private $chatId;
    
    /**
     * 
     * @ORM\Column(type="boolean", nullable=false, options={"default"=1})
     */
    private $chatActive;
}

?>