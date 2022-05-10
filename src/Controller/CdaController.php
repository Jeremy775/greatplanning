<?php

namespace App\Controller;

use App\Entity\Cda;
use App\Form\CdaType;
use App\Repository\CdaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cda')]
class CdaController extends AbstractController
{
    #[Route('/', name: 'app_cda_index', methods: ['GET'])]
    public function index(CdaRepository $cdaRepository): Response
    {
        return $this->render('cda/index.html.twig', [
            'cdas' => $cdaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cda_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CdaRepository $cdaRepository): Response
    {
        $cda = new Cda();
        $form = $this->createForm(CdaType::class, $cda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cdaRepository->add($cda);
            return $this->redirectToRoute('app_cda_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cda/new.html.twig', [
            'cda' => $cda,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cda_show', methods: ['GET'])]
    public function show(Cda $cda): Response
    {
        return $this->render('cda/show.html.twig', [
            'cda' => $cda,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cda_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cda $cda, CdaRepository $cdaRepository): Response
    {
        $form = $this->createForm(CdaType::class, $cda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cdaRepository->add($cda);
            return $this->redirectToRoute('app_cda_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cda/edit.html.twig', [
            'cda' => $cda,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cda_delete', methods: ['POST'])]
    public function delete(Request $request, Cda $cda, CdaRepository $cdaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cda->getId(), $request->request->get('_token'))) {
            $cdaRepository->remove($cda);
        }

        return $this->redirectToRoute('app_cda_index', [], Response::HTTP_SEE_OTHER);
    }
}
