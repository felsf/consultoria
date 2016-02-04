<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="comment_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $commentId;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_title", type="string", length=100, nullable=true)
     */
    private $commentTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_content", type="text", length=65535, nullable=false)
     */
    private $commentContent;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_author", type="string", length=45, nullable=false)
     */
    private $commentAuthor;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_author_ip", type="string", length=45, nullable=false)
     */
    private $commentAuthorIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="comment_date", type="datetime", nullable=false)
     */
    private $commentDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="comment_edit_date", type="datetime", nullable=true)
     */
    private $commentEditDate;   
    
    ///

    public function getCommentId()
    {
        return $this->commentId;
    }

    public function setCommentId(integer $commentId)
    {
        $this->commentId = $commentId;
        return $this;
    }

    public function getCommentTitle()
    {
        return $this->commentTitle;
    }

    public function setCommentTitle($commentTitle)
    {
        $this->commentTitle = $commentTitle;
        return $this;
    }

    public function getCommentContent()
    {
        return $this->commentContent;
    }

    public function setCommentContent($commentContent)
    {
        $this->commentContent = $commentContent;
        return $this;
    }

    public function getCommentAuthor()
    {
        return $this->commentAuthor;
    }

    public function setCommentAuthor($commentAuthor)
    {
        $this->commentAuthor = $commentAuthor;
        return $this;
    }

    public function getCommentAuthorIp()
    {
        return $this->commentAuthorIp;
    }

    public function setCommentAuthorIp($commentAuthorIp)
    {
        $this->commentAuthorIp = $commentAuthorIp;
        return $this;
    }

    public function getCommentDate()
    {
        return $this->commentDate;
    }

    public function setCommentDate(\DateTime $commentDate)
    {
        $this->commentDate = $commentDate;
        return $this;
    }

    public function getCommentEditDate()
    {
        return $this->commentEditDate;
    }

    public function setCommentEditDate(\DateTime $commentEditDate)
    {
        $this->commentEditDate = $commentEditDate;
        return $this;
    }
}