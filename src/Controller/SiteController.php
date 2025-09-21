<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SiteController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function accueil(CategorieRepository $categorieRepository, ProduitRepository $produitRepository): Response
    {
        $cCategories = $categorieRepository->findCategoriesPhares(5);
        $cProduit = $produitRepository->findProduitPhares(10);

        return $this->render('site/accueil.html.twig', [
            'products' => $cProduit,
            'categories' => $cCategories
        ]);
    }
}
