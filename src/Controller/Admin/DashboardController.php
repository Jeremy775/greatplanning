<?php

namespace App\Controller\Admin;

use App\Entity\Cda;
use App\Entity\Cours;
use App\Entity\User;
use App\Entity\Classe;
use App\Entity\Formations;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    // TITRE SUR LE DASHBOARD
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Greatplanning');
    }

    // LISTE MENU
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour sur le site', 'fa fa-undo', 'planning' );

        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-user-astronaut', User::class);
        yield MenuItem::linkToCrud('Classes', 'fa-solid fa-door-open', Classe::class);
        yield MenuItem::linkToCrud('Formations', 'fa-solid fa-book', Formations::class);
        yield MenuItem::linkToCrud('Cours', 'fa-solid fa-book-open', Cours::class);
        yield MenuItem::linkToCrud('Planning Cda', 'fa-solid fa-book-open', Cda::class);
    }
}
