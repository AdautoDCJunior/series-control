<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class SeriesController
{
    #[Route('/series', 'app_series')]
    public function getAll(): JsonResponse
    {
        $seriesList = [
            'LoKi',
            'Game of Thrones',
            'Suits',
            'Upload',
            'Friends'
        ];

        return new JsonResponse($seriesList);
    }
}