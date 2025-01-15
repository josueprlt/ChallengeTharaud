<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\UX\Chartjs\Model\Chart;

#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private ChartBuilderInterface $chartBuilder,
    ) {}

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Redirige directement vers une entité par défaut, comme Book
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(BookCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("Appli d'administration");
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Book', 'fas fa-list', Book::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', User::class);
    }
}
