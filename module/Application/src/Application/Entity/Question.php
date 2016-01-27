<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity
 */
class Question
{
    /**
     * @var integer
     *
     * @ORM\Column(name="question_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $questionId;

    /**
     * @var string
     *
     * @ORM\Column(name="question_title", type="text", nullable=false)
     */
    private $questionTitle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="question_date", type="datetime", nullable=false)
     */
    private $questionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="question_author", type="string", length=45, nullable=false)
     */
    private $questionAuthor;

    /**
     * @var string
     *
     * @ORM\Column(name="question_author_email", type="string", length=45, nullable=false)
     */
    private $questionAuthorEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="question_author_ip", type="string", length=45, nullable=false)
     */
    private $questionAuthorIp;

    
    ////////////////////////////////////////////////////////////    

 /**
     * @return the $questionId
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

 /**
     * @return the $questionTitle
     */
    public function getQuestionTitle()
    {
        return $this->questionTitle;
    }

 /**
     * @return the $questionDate
     */
    public function getQuestionDate()
    {
        return $this->questionDate;
    }

 /**
     * @return the $questionAuthor
     */
    public function getQuestionAuthor()
    {
        return $this->questionAuthor;
    }

 /**
     * @return the $questionAuthorEmail
     */
    public function getQuestionAuthorEmail()
    {
        return $this->questionAuthorEmail;
    }

 /**
     * @return the $questionAuthorIp
     */
    public function getQuestionAuthorIp()
    {
        return $this->questionAuthorIp;
    }


 /**
     * @param number $questionId
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;
    }

 /**
     * @param string $questionTitle
     */
    public function setQuestionTitle($questionTitle)
    {
        $this->questionTitle = $questionTitle;
    }

 /**
     * @param DateTime $questionDate
     */
    public function setQuestionDate($questionDate)
    {
        $this->questionDate = $questionDate;
    }

 /**
     * @param string $questionAuthor
     */
    public function setQuestionAuthor($questionAuthor)
    {
        $this->questionAuthor = $questionAuthor;
    }

 /**
     * @param string $questionAuthorEmail
     */
    public function setQuestionAuthorEmail($questionAuthorEmail)
    {
        $this->questionAuthorEmail = $questionAuthorEmail;
    }

 /**
     * @param string $questionAuthorIp
     */
    public function setQuestionAuthorIp($questionAuthorIp)
    {
        $this->questionAuthorIp = $questionAuthorIp;
    }
    
}

