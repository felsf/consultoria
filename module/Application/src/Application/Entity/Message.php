<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Entity
 * @ORM\Table(name="message")
 */
class Message
{
    /**
     * 
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=false)
     */
    private $messageId;
    
    /**
     * @var \Application\Entity\Chat
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Chat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chat", referencedColumnName="chatId")
     * })
     */
    private $chat;
    
    /**
     * 
     * @ORM\Column(type="text", nullable=false)
     */
    private $messageContent;
}

?>