<?php

namespace App\Controller;

use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SerieController extends AbstractController
{
    #[Route('/series/{page}', name: 'app_serie_list', requirements: ['page' => '\d+'], defaults: ['page' =>1])]
    public function list(SerieRepository $serieRepository, int $page): Response
    {
        $nbByPage = 10;
        $offset = ($page * $nbByPage) - $nbByPage;
        //$series = $serieRepository->findAll();
        $criterias =['status' => 'Returning', 'genres'=>'Gore'];
        $nbTotal = $serieRepository->count($criterias);


        $series = $serieRepository->findBy( $criterias, ['vote'=> 'DESC'], $nbByPage, $offset);



        return $this->render('serie/index.html.twig', ['series'=>$series, 'page'=>$page, 'nbPageMax'=> ceil($nbTotal / $nbByPage)] );
    }


}
