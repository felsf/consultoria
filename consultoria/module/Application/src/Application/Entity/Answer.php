<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Table(name="answer", indexes={@ORM\Index(name="answer_question_idx", columns={"answer_question"}), @ORM\Index(name="answer_author_idx", columns={"answer_author"})})
 * @ORM\Entity
 */
class Answer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="answer_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $answerId;

    /**
     * @var string
     *
     * @ORM\Column(name="answer_content", type="text", length=65535, nullable=false)
     */
    private $answerContent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="answer_date", type="datetime", nullable=false)
     */
    private $answerDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="answer_edit_date", type="datetime", nullable=true)
     */
    private $answerEditDate;

    /**
     * @var \Application\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="answer_author", referencedColumnName="user_id")
     * })
     */
    private $answerAuthor;

    /**
     * @var \Application\Entity\Question
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="answer_question", referencedColumnName="question_id")
     * })
     */
    private $answerQuestion;

    ////////////////////////////////////////////////////////////

 /**
     * @return the $answerId
     */
    public function getAnswerId()
    {
        return $this->answerId;
    }

 /**
     * @return the $answerContent
     */
    public function getAnswerContent()
    {
        return $this->answerContent;
    }

 /**
     * @return the $answerDate
     */
    public function getAnswerDate()
    {
        return $this->answerDate;
    }

 /**
     * @return the $answerEditDate
     */
    public function getAnswerEditDate()
    {
        return $this->answerEditDate;
    }

 /**
     * @return the $answerAuthor
     */
    public function getAnswerAuthor()
    {
        return $this->answerAuthor;
    }

 /**
     * @return the $answerQuestion
     */
    public function getAnswerQuestion()
    {
        return $this->answerQuestion;
    }

 /**
     * @param number $answerId
     */
    public function setAnswerId($answerId)
    {
        $this->answerId = $answerId;
    }

 /**
     * @param string $answerContent
     */
    public function setAnswerContent($answerContent)
    {
        $this->answerContent = $answerContent;
    }

 /**
     * @param DateTime $answerDate
     */
    public function setAnswerDate($answerDate)
    {
        $this->answerDate = $answerDate;
    }

 /**
     * @param DateTime $answerEditDate
     */
    public function setAnswerEditDate($answerEditDate)
    {
        $this->answerEditDate = $answerEditDate;
    }

 /**
     * @param \Application\Entity\User $answerAuthor
     */
    public function setAnswerAuthor($answerAuthor)
    {
        $this->answerAuthor = $answerAuthor;
    }

 /**
     * @param \Application\Entity\Question $answerQuestion
     */
    public function setAnswerQuestion($answerQuestion)
    {
        $this->answerQuestion = $answerQuestion;
    }
}

