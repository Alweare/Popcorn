<?php

namespace App\Controller;

use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SerieController extends AbstractController
{
    #[Route('/serie', name: 'app_serie')]
    public function index(SerieRepository $serieRepository): Response
    {
        $series = $serieRepository->findAll();


        return $this->render('serie/index.html.twig', ['series'=>$series] );
    }
}
