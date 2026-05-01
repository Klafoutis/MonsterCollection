<?php

namespace App\Controller\Admin;

use App\Entity\Monster;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        // Affiche la page d'accueil par défaut d'EasyAdmin avec toutes ses variables
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Monster Back-Office');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');

        yield MenuItem::section('Le Catalogue');
        yield MenuItem::linkTo(MonsterCrudController::class, 'Toutes les canettes', 'fas fa-list');
        // Lien spécifique pré-filtré pour la modération
        yield MenuItem::linkTo(MonsterCrudController::class, 'File de modération', 'fas fa-gavel')
            ->setAction('index')
            // On filtre pour n'afficher que celles dont le statut est "pending"
            ->setQueryParameter('filters[status]', 'pending'); 

        yield MenuItem::section('Communauté');
        yield MenuItem::linkTo(UserCrudController::class, 'Membres', 'fas fa-users');
    }
}
