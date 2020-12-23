<?php

namespace App\Controller;

use App\Entity\Homepage;
use App\Form\HomepageType;
use App\Repository\HomepageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/homepage")
 */
class HomepageController extends AbstractController
{
    /**
     * name="homepage_show", methods={"GET"})
     */
    public function show(HomepageRepository $homepageRepository): Response
    {
        return $this->render('homepage/show.html.twig', [
            'homepage' => $homepageRepository->findAll()[0],
        ]);
    }
}