<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SeriesController extends AbstractController
{
    #[Route('/series', 'app_series', methods: ['GET'])]
    public function getAll(): Response
    {
        $seriesList = [
            'LoKi',
            'Game of Thrones',
            'Suits',
            'Upload',
            'Friends',
        ];

        return $this->render('series/index.html.twig', [
            'seriesList' => $seriesList,
        ]);
    }

    #[Route('/series/create', methods: ['GET'])]
    public function addForm(): Response
    {
        return $this->render('series/form.html.twig');
    }
}