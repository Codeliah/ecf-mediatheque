<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Book;
use App\Entity\Member;
use App\Entity\Employee;

class DashboardController extends AbstractDashboardController
{
    
     * @Route("/admin", name="admin")
    
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Panneau d\'admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Members', 'far fa-user', Member::class);
        yield MenuItem::linkToCrud('Employees', 'fas fa-user-tie', Employee::class);

        yield MenuItem::section('Catalog');
        yield MenuItem::linkToCrud('Books', 'fas fa-book', Book::class);

        
    }
}