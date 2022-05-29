<?php

namespace App\Controller;

use App\Entity\Commentaires;
use App\Entity\Cours;
use App\Entity\Images;
use App\Form\CommentType;
use App\Form\CoursType;
use App\Repository\CommentairesRepository;
use App\Repository\CoursRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cours')]
class CoursController extends AbstractController
{


    #[Route('/', name: 'app_cours_index', methods: ['GET'])]
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('cours/index.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }




    #[Route('/new', name: 'app_cours_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_FORMATEUR', statusCode: 404, message: "Il n'y a rien à voir ici")]
    public function new(Request $request, CoursRepository $coursRepository): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupere les images
            $images = $form->get('images')->getData();
            foreach($images as $image)
            {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // On copie le fichier dans le dossier uploads/cours
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                // On stock le chemin de l'image ds la bdd
                $img = new Images();
                $img->setName($fichier);
                $cour->addImage($img);
            }

            $coursRepository->add($cour);
            return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cours/new.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }



    #[Route('/{id}', name: 'app_cours_show', methods: ['GET', 'POST'])]
    public function show(Cours $cour, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Commentaires
        // On créer le commentaire
        $comm = new Commentaires();

        // On genere le formulaire
        $form = $this->createForm(CommentType::class, $comm);

        $form->handleRequest($request);

        // Traitement du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $comm->setCreatedAt(new DateTime());
            $comm->setCours($cour);

            $entityManager->persist($comm);
            $entityManager->flush();

            return $this->redirectToRoute('app_cours_show', ['id' => $cour->getId()]);
        }

        return $this->render('cours/show.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }



    #[Route('/{id}/edit', name: 'app_cours_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_FORMATEUR', statusCode: 404, message: "Il n'y a rien à voir ici")]
    public function edit(Request $request, Cours $cour, CoursRepository $coursRepository): Response
    {
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupere les images
            $images = $form->get('images')->getData();
            foreach($images as $image)
            {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
 
                // On copie le fichier dans le dossier uploads/cours
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
 
                // On stock le chemin de l'image ds la bdd
                $img = new Images();
                $img->setName($fichier);
                $cour->addImage($img);
            }

            $coursRepository->add($cour);
            return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cours/edit.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }




    #[Route('/{id}', name: 'app_cours_delete', methods: ['POST'])]
    #[IsGranted('ROLE_FORMATEUR', statusCode: 404, message: "Il n'y a rien à voir ici")]
    public function delete(Request $request, Cours $cour, CoursRepository $coursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $coursRepository->remove($cour);
        }

        return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
    }




    
    #[Route('/supprime/commentaire/{id}', name: 'app_cours_delete_comm', methods: ['POST'])]
    #[IsGranted('ROLE_FORMATEUR', statusCode: 404, message: "Il n'y a rien à voir ici")]
    public function deleteComm(Cours $cour, Request $request, Commentaires $comm, CommentairesRepository $commentairesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comm->getId(), $request->request->get('_token'))) {
            $commentairesRepository->remove($comm);
        }

        return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
    }




    #[Route("/supprime/image/{id}", name: 'app_cours_delete_img', methods: ['DELETE'])]
    #[IsGranted('ROLE_FORMATEUR', statusCode: 404, message: "Il n'y a rien à voir ici")]
    public function deleteImg(Images $image, Request $request, EntityManagerInterface $entityManager)
    {
        $data = json_decode($request->getContent(), true);

        if($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token'])){
            // On récupere le nom du fichier
            $nom = $image->getName();
            // On supprime le fichier du disque
            unlink($this->getParameter('images_directory').'/'.$nom);

            // On supprime de la bdd
            $entityManager->remove($image);
            $entityManager->flush();

            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error' => 'Token Invalid'], 400);
        }
    }
}
