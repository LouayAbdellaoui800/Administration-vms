<?php

namespace App\Controller\Admin;

use App\Entity\Pc;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class DashboardController extends AbstractDashboardController
{


    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )
    {

    }
    #[Route('/admin', name: 'admin')]
    #[IsGranted("IS_AUTHENTICATED_FULLY")]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $url = $this->adminUrlGenerator->setController(PcCrudController::class)->generateUrl();
        return $this->redirect($url);

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Virtual Machine Monitoring Project');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        //yield MenuItem::linkToCrud('Users','fas fa-users',User::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class)->setLinkTarget('_self'); // Open the link in the same tab/window
        yield MenuItem::section('Virtual Machines');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add Virtual Machine', 'fas fa-plus', Pc::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToRoute('Show Virtual Machines', 'fas fa-eye', 'monitor'),
            //MenuItem::linkToRoute('Update Virtual Machine', 'fas fa-edit', 'update_vm',['id':[$id]])
        ]);

    }
}
