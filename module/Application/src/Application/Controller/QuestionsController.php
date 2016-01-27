<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Question;
use Application\Entity\Answer;
use Application\Form\QuestionForm;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

class QuestionsController extends AbstractActionController
{
    public function indexAction()
    {
    	$qb = $this->getEntityManager()->getRepository("Application\Entity\Question")->createQueryBuilder('q');
    	$aqb = $this->getEntityManager()->getRepository("Application\Entity\Answer")->createQueryBuilder('a');

    	$answers = $aqb->select()->orderBy('a.answerId', 'ASC')->getQuery()->getResult();
    	$questions = $qb->select()->orderBy('q.questionDate', 'DESC')->getQuery()->getResult();

    	$a = array();
    	$q = array();

    	foreach($answers as $answer)
    	{
    		$a[$answer->getAnswerQuestion()->getQuestionId()] = array($answer);
    	}

    	foreach($questions as $question)
    	{
    		if(!empty($a[$question->getQuestionId()]))
    		{
    			$q[$question->getQuestionId()] = array($question);
    		}
    	}

        $trans = new SmtpTransport();
        $options = new SmtpOptions(array('name' => 'smtp.live.com', 'host' => 'smtp.live.com', 'port' => 25, 'connection_class' => 'login', 'connection_config' => array('username' => 'email', 'password' => 'senha', 'ssl' => 'tls')));
        $msg = new Message();

        $msg->addTo('destino')->addFrom('origem')->setSubject("Teste")->setBody("Assuntos diários")
        ;

        $trans->setOptions($options);
        $trans->send($msg);

        return new ViewModel(array('answers' => $a, 'questions' => $q));
    }

    public function addAction()
    {
    	$questionForm = new QuestionForm();
    	$request = $this->getRequest();

    	if($request->isPost())
    	{
    		$qs = new Question();
    		$qs->setQuestionAuthor($request->getPost('question_author'));
    		$qs->setQuestionAuthorEmail($request->getPost('question_author_email'));
    		$qs->setQuestionTitle($request->getPost('question_title'));    		
    		$qs->setQuestionDate(new \DateTime('now'));
    		$qs->setQuestionAuthorIp($_SERVER['REMOTE_ADDR']);

    		$this->getEntityManager()->persist($qs);
    		$this->getEntityManager()->flush();

    		$this->flashMessenger()->addInfoMessage("Pergunta registrada com sucesso. Você receberá uma notificação por email quando a mesma for respondida!");
    		return $this->redirect()->toRoute('questions');
    	}

    	return new ViewModel(array('questionForm' => $questionForm));
    }

    public function listAction()
    {
    	$qb = $this->getEntityManager()->getRepository("Application\Entity\Question")->createQueryBuilder('q');
    	$questions = $qb->select()->orderBy('q.questionDate', 'DESC')->getQuery()->getResult();

    	$aqb = $this->getEntityManager()->getRepository("Application\Entity\Answer")->createQueryBuilder('a');
        $answers = array();

        foreach($aqb->select()->orderBy('a.answerQuestion', 'ASC')->getQuery()->getResult() as $answer)
        {
        	$answers[$answer->getAnswerQuestion()->getQuestionId()] = array($answer);
        }

    	return new ViewModel(array('questions' => $questions, 'answers' => $answers));
    }

    public function replyAction()
    {
    	$id = $this->params('id');
        $request = $this->getRequest();
        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Question")->createQueryBuilder('q');
            $question = $qb->select()->where('q.questionId = '.$id)->getQuery()->getResult();
        
            if(empty($question)) return $this->redirect()->toRoute('questions-list');
            $question = $question[0];

            if($request->isPost())
            {
            	$answer = new Answer();
            	$answer->setAnswerAuthor($this->identity());
            	$answer->setAnswerDate(new \DateTime('now'));
            	$answer->setAnswerContent($request->getPost("answer_content"));
            	$answer->setAnswerQuestion($question);

            	$this->getEntityManager()->persist($answer);
            	$this->getEntityManager()->flush();

            	$this->flashMessenger()->addSuccessMessage("Pergunta respondida com sucesso!");
            	return $this->redirect()->toRoute('questions-list');
            }
        }

        return new ViewModel(array('question' => $question));
    }


    public function deleteAction()
    {
    	$id = $this->params('id');
        $request = $this->getRequest();
        
        if(isset($id))
        {
            $qb = $this->getEntityManager()->getRepository("Application\Entity\Question")->createQueryBuilder('q');
            $question = $qb->select()->where('q.questionId = '.$id)->getQuery()->getResult();  	        	

            if(empty($question)) return $this->redirect()->toRoute('questions-list');
            $question = $question[0];

            $aqb = $this->getEntityManager()->getRepository("Application\Entity\Answer")->createQueryBuilder('a');
            $answer = $aqb->select()->where("a.answerQuestion = ".$question->getQuestionId())->getQuery()->getResult();

            if(!empty($answer))
            {
            	$this->getEntityManager()->remove($answer[0]);
            	$this->getEntityManager()->flush();
            }

            $this->getEntityManager()->remove($question);
            $this->getEntityManager()->flush();
            $this->flashMessenger()->addSuccessMessage("Pergunta apagada com sucesso!");

            return $this->redirect()->toRoute('questions-list');
        }

        return new ViewModel(array());
    }
}