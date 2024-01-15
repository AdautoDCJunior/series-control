<?php

namespace App\Controller;

use App\Entity\SeriesEntity;
use App\Repository\SeriesRepository;
use SeriesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SeriesController extends AbstractController
{
    public function __construct(private SeriesRepository $seriesRepository) { }

    #[Route('/series', 'app_series', methods: ['GET'])]
    public function getAll(Request $request): Response
    {
        $seriesList = $this->seriesRepository->findAll();

        return $this->render('series/index.html.twig', compact('seriesList'));
    }

    #[Route('/series/create', 'app_add_series_form', methods: ['GET'])]
    public function addSeriesForm(): Response
    {
        $seriesForm = $this->createForm(SeriesType::class, new SeriesEntity());

        return $this->render('series/form.html.twig', compact('seriesForm'));
    }

    #[Route('/series/create', 'app_add_series', methods: ['POST'])]
    public function addSeries(Request $request): RedirectResponse
    {
        $series = new SeriesEntity();
        $this->createForm(SeriesType::class, $series)->handleRequest($request);

        $this->seriesRepository->add($series, true);

        $this->addFlash(
            'success',
            "Série \"{$series->getName()}\" adicionada com sucesso"
        );

        return new RedirectResponse('/series');
    }

    #[Route(
        '/series/update/{series}',
        'app_update_series_form',
        methods: ['GET'])
    ]
    public function updateSeriesForm(SeriesEntity $series): Response
    {
        return $this->render('series/form.html.twig', compact('series'));
    }

    #[Route('/series/update/{series}', 'app_update_series', methods: ['PUT'])]
    public function updateSeries(
        SeriesEntity $series,
        Request $request
    ): RedirectResponse
    {
        $series->setName($request->request->get('name'));
        $this->seriesRepository->flush();

        $this->addFlash(
            'success',
            "Série \"{$series->getName()}\" editada com sucesso"
        );

        return new RedirectResponse('/series');
    }

    #[Route(
        '/series/delete/{id}',
        'app_delete_series',
        ['id' => '\d+'],
        methods: ['DELETE']
    )]
    public function deleteSeries(int $id, Request $request): RedirectResponse
    {
        $this->seriesRepository->removeById($id);

        $this->addFlash('success', 'Série removida com sucesso');

        return new RedirectResponse('/series');
    }
}