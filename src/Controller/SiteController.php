<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SiteController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function accueil(): Response
    {
        return $this->render('site/accueil.html.twig', [
            'products' => [],
            'categories' => []
        ]);
    }
}
