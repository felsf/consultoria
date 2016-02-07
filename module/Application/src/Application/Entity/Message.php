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
     * @ORM\GeneratedValue(strategy="AUTO")
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

    public function getMessageId()
    {
        return $this->messageId;
    }

    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
        return $this;
    }

    public function getChat()
    {
        return $this->chat;
    }

    public function setChat($chat)
    {
        $this->chat = $chat;
        return $this;
    }

    public function getMessageContent()
    {
        return $this->messageContent;
    }

    public function setMessageContent($messageContent)
    {
        $this->messageContent = $messageContent;
        return $this;
    }
 
}

?>