<?php

namespace App\Controller;

use App\Entity\Cda;
use App\Repository\CdaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
                'url' => $event->getUrl(),
                'description' => $event->getDescription(),
                'backgroundColor' => $event->getBackgroundColor(),
                'allDay' => $event->getAllDay(),
            ];
        }

        $data = json_encode($cours);

        return $this->render('planning/index.html.twig', compact('data'));
    }
}
