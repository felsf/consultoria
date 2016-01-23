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


}

