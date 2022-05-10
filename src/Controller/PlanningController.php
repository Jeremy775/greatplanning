<?php

namespace App\Controller;

use App\Repository\CdaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{
    #[Route('/planning', name: 'planning')]
    public function index(CdaRepository $cda): Response
    {
        $events = $cda->findAll();

        $cours = [];
        foreach ($events as $event) {
            $cours[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'background_color' => $event->getBackgroundColor(),

            ];
        }

        $data = json_encode($cours);

        return $this->render('planning/index.html.twig', compact('data'));
    }
}
