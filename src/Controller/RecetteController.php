<?php

namespace App\Controller;

use App\Services\RecetteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Recette;

class RecetteController extends AbstractController
{
    /**
     * @Route("/api/recette", name="recette")
     */
    
    public function index(RecetteService $recetteService): Response
    {   
        $listeRecette = $recetteService->getList();
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
            'listeRecette'=>$listeRecette,
        ]);
    }
    /**
     * @Route("/api/recette/{pId}", "recetteID")
     */

    public function show($pId, RecetteService $recetteService): Response
    {
        $recette = $recetteService->getRecette($pId);
        return $this->render('recette/recette.html.twig',['recette' => $recette['recette']]);
    }
}
