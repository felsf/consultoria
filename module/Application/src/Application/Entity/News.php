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
    * @ORM\Column(name="news_type", type="integer", nullable=false, options={"default"=0})
    **/
    private $newsType = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="news_source", type="text", length=65535, nullable=true)
     */
    private $newsSource;
    
    /**
    * @ORM\Column(name="news_published", type="boolean", options={"default"=1})
    */
    private $newsPublished;
    
    /**
     * @var \Application\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="news_author", referencedColumnName="user_id")
     * })
     */
    private $newsAuthor;
    
    /////////////////////////////////////////

 /**
     * @return the $newsId
     */
    public function getNewsId()
    {
        return $this->newsId;
    }

 /**
     * @return the $newsTitle
     */
    public function getNewsTitle()
    {
        return $this->newsTitle;
    }

 /**
     * @return the $newsContent
     */
    public function getNewsContent()
    {
        return $this->newsContent;
    }

 /**
     * @return the $newsDate
     */
    public function getNewsDate()
    {
        return $this->newsDate;
    }

 /**
     * @return the $newsEditDate
     */
    public function getNewsEditDate()
    {
        return $this->newsEditDate;
    }

 /**
     * @return the $newsSource
     */
    public function getNewsSource()
    {
        return $this->newsSource;
    }

 /**
     * @return the $newsPublished
     */
    public function getNewsPublished()
    {
        return $this->newsPublished;
    }

 /**
     * @return the $newsAuthor
     */
    public function getNewsAuthor()
    {
        return $this->newsAuthor;
    }

 /**
     * @param number $newsId
     */
    public function setNewsId($newsId)
    {
        $this->newsId = $newsId;
    }

 /**
     * @param string $newsTitle
     */
    public function setNewsTitle($newsTitle)
    {
        $this->newsTitle = $newsTitle;
    }

 /**
     * @param string $newsContent
     */
    public function setNewsContent($newsContent)
    {
        $this->newsContent = $newsContent;
    }

 /**
     * @param DateTime $newsDate
     */
    public function setNewsDate($newsDate)
    {
        $this->newsDate = $newsDate;
    }

 /**
     * @param DateTime $newsEditDate
     */
    public function setNewsEditDate($newsEditDate)
    {
        $this->newsEditDate = $newsEditDate;
    }

 /**
     * @param string $newsSource
     */
    public function setNewsSource($newsSource)
    {
        $this->newsSource = $newsSource;
    }

 /**
     * @param field_type $newsPublished
     */
    public function setNewsPublished($newsPublished)
    {
        $this->newsPublished = $newsPublished;
    }

 /**
     * @param \Application\Entity\User $newsAuthor
     */
    public function setNewsAuthor($newsAuthor)
    {
        $this->newsAuthor = $newsAuthor;
    }
    
    public function getNewsType()
    {
        return $this->newsType;        
    }

    public function setNewsType($type)
    {
        $this->newsType = $type;
    }


}

