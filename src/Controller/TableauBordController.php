<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\DashboardController;
class TableauBordController extends DashboardController
{
    #[Route('/stats', name: 'app_stats')]
    public function index(): Response
    {
        return parent::index();
        return $this->render('tableau_bord/index.html.twig', [
            'controller_name' => 'TableauBordController',
        ]);
    }
}
