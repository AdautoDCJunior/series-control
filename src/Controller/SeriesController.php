<?php

namespace App\Controller;

use App\Entity\SeriesEntity;
use App\Repository\SeriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SeriesController extends AbstractController
{
    public function __construct(private SeriesRepository $seriesRepository)
    {

    }

    #[Route('/series', 'app_series', methods: ['GET'])]
    public function getAll(): Response
    {
        $seriesList = $this->seriesRepository->findAll();

        return $this->render('series/index.html.twig', [
            'seriesList' => $seriesList,
        ]);
    }

    #[Route('/series/create', methods: ['GET'])]
    public function addSeriesForm(): Response
    {
        return $this->render('series/form.html.twig');
    }

    #[Route('/series/create', methods: ['POST'])]
    public function addSeries(Request $request): RedirectResponse
    {
        $seriesName = $request->request->get('name');
        $series = new SeriesEntity($seriesName);

        $this->seriesRepository->add($series, true);

        return new RedirectResponse('/series');
    }
}