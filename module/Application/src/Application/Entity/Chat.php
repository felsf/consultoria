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
     * @ORM\Column(name="chatId", type="integer", nullable=false)
     */
    private $chatId;
    
    /**
     * 
     * @ORM\Column(type="boolean", nullable=false, options={"default"=1})
     */
    private $chatActive;

    /**
     * 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $chatCreated;
    
    //-----------------------------------------//
    
    public function getChatId()
    {
        return $this->chatId;
    }

    public function setChatId($chatId)
    {
        $this->chatId = $chatId;
        return $this;
    }

    public function getChatActive()
    {
        return $this->chatActive;
    }

    public function setChatActive($chatActive)
    {
        $this->chatActive = $chatActive;
        return $this;
    }

    public function getChatCreated()
    {
        return $this->chatCreated;
    }

    public function setChatCreated($chatCreated)
    {
        $this->chatCreated = $chatCreated;
        return $this;
    }
 
 
}

?>