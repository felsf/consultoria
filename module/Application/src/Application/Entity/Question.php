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
     * @ORM\Column(name="question_title", type="string", length=100, nullable=false)
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

    /**
     * @var boolean
     *
     * @ORM\Column(name="question_approved", type="boolean", nullable=false)
     */
    private $questionApproved = '0';


}

