<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news", indexes={@ORM\Index(name="news_author_idx", columns={"news_author"})})
 * @ORM\Entity
 */
class News
{
    /**
     * @var integer
     *
     * @ORM\Column(name="news_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $newsId;

    /**
     * @var string
     *
     * @ORM\Column(name="news_title", type="string", length=150, nullable=false)
     */
    private $newsTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="news_content", type="text", length=65535, nullable=false)
     */
    private $newsContent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="news_date", type="datetime", nullable=false)
     */
    private $newsDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="news_edit_date", type="datetime", nullable=true)
     */
    private $newsEditDate;

    /**
     * @var string
     *
     * @ORM\Column(name="news_source", type="text", length=65535, nullable=false)
     */
    private $newsSource;

    /**
     * @var \Application\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="news_author", referencedColumnName="user_id")
     * })
     */
    private $newsAuthor;


}

