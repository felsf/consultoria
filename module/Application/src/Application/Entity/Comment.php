<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment", indexes={@ORM\Index(name="comment_news_idx", columns={"comment_news"})})
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

    /**
     * @var \Application\Entity\News
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\News")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comment_news", referencedColumnName="news_id")
     * })
     */
    private $commentNews;


}

