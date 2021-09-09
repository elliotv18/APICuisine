<?php 
namespace App\Services;

use App\Entity\Recette;
use Doctrine\ORM\EntityManagerInterface;

class RecetteService
{
    private $_entityManager = [];
    private $_listeRecette = [];

    function __construct(EntityManagerInterface $em)
    {
        $this->_entityManager = $em;
        $this->_listeRecette = $this->_entityManager->getRepository(Recette::class)->findAll();
    }
    
function getList()
    {
        return $this->_listeRecette;
    }
    function addRecette($pRecette)
    {
        array_push($this->_listeRecette,$pRecette);
        $this->_entityManager->persist($pRecette);
        $this->_entityManager->flush();
    }
    public function getRecette($pId)
    {
         $find = false;
         $recette = $this->_entityManager->getRepository(Recette::class)->find($pId);
         if (isset($recette))
             $find = true;
         return  ['found'=>$find,'recette'=>$recette];
     }
     public function delRecette($pId)
    {
        $recette = $this->getRecette($pId);
        if ($recette['found']== true)
        {
            $this->_entityManager->remove($recette['recette']);
            $this->_entityManager->flush();
        }
        
    }
    
}