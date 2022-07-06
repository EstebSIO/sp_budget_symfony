<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\MoyensPaiement;
use App\Entity\Transactions;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
class DashboardController extends AbstractDashboardController
{
    public function __construct(ChartBuilderInterface $chartBuilder){
        $this->chartBuilder = $chartBuilder;
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         //return $this->redirect($adminUrlGenerator->setController(UsersCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        // ...set chart data and options somehow
        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);
         return $this->render('dashboard/index_dash.html.twig',[
             'chart' => $chart
         ]);
    }

    public function configureDashboard(): Dashboard
    { return Dashboard::new()
        // the name visible to end users
        ->setTitle('SP Budget')
        // you can include HTML contents too (e.g. to link to an image)
        ->setTitle('<img src="..."> SP <span class="text-small">Budget</span>')

        // by default EasyAdmin displays a black square as its default favicon;
        // use this method to display a custom favicon: the given path is passed
        // "as is" to the Twig asset() function:
        // <link rel="shortcut icon" href="{{ asset('...') }}">
        ->setFaviconPath('favicon.svg')

        // the domain used by default is 'messages'
        //->setTranslationDomain('my-custom-domain')

        // there's no need to define the "text direction" explicitly because
        // its default value is inferred dynamically from the user locale
        ->setTextDirection('ltr')

        // set this option if you prefer the page content to span the entire
        // browser width, instead of the default design which sets a max width
        ->renderContentMaximized()

        // set this option if you prefer the sidebar (which contains the main menu)
        // to be displayed as a narrow column instead of the default expanded design
        // by default, users can select between a "light" and "dark" mode for the
        // backend interface. Call this method if you prefer to disable the "dark"
        // mode for any reason (e.g. if your interface customizations are not ready for it)
        //->disableDarkMode()

        // by default, all backend URLs are generated as absolute URLs. If you
        // need to generate relative URLs instead, call this method
        ->generateRelativeUrls()
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de Bord', 'fa fa-home');
        yield MenuItem::linkToRoute('Tableau de Stats', 'fa fa-home',"app_stats");
        yield MenuItem::linkToCrud('Moyens de Paiement', 'fa-solid fa-credit-card', MoyensPaiement::class);
        yield MenuItem::linkToCrud('Transactions', 'fa-solid fa-basket-shopping', Transactions::class);
        yield MenuItem::linkToCrud('Catégories', 'fa-solid fa-grip-lines', Categories::class);
    }
}
