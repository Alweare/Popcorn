<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/test_persist', name: 'app_test_persist')]
    public function testPersist(EntityManagerInterface $em): Response
    {
        $serie = new Serie();
        $serie->setName('Buffy contre les vampires')
            ->setOverview('Buffy se bat contre les forces du mal ...')
            ->setStatus('ENDED')
            ->setGenres('Comedy,Fantasy,Horror',)
            ->setFirstAirDate(new \DateTime('1997-03-10'))
            ->setFirstAirDate(new \DateTime('2003-05-20'))
            ->setDateCreated(new \DateTime());
        $em->persist($serie);
        $em->flush();

        return new Response('l\'entité est en base (normalement)');
    }

    #[Route('/test_update/{id}', name: 'app_test_update', requirements: ['id' => '\d+'])]
    public function testUpdate(SerieRepository $serieRepository, EntityManagerInterface $em, int $id):Response
    {
        $serie = $serieRepository->find($id);

        $serie->setOverview('Buffy en a fini avec les démons');
        $serie->setDateModified(new \DateTime());

        $em->flush();





        return new Response('l\'entité est à jour (normalement)');
    }


}
