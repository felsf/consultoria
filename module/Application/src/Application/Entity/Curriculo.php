<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Entity
 * @ORM\Table(name="curriculo")
 */
class Curriculo
{
    /**     
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="curriculoId", type="integer", nullable=false)
     */
    private $curriculoId;
    
    /**
     * 
     * @ORM\Column(type="text", nullable=true)
     */
    private $curriculoContent;   
    
    //-----------------------------------------// 
 
    public function getCurriculoId(){
        return $this->curriculoId;
    }

    public function setCurriculoId($curriculoId){
        $this->curriculoId = $curriculoId;
    }

    public function getCurriculoContent(){
        return $this->curriculoContent;
    }

    public function setCurriculoContent($curriculoContent){
        $this->curriculoContent = $curriculoContent;
    }
}

?>