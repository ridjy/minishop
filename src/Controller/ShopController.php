<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

final class ShopController extends AbstractController
{
    #[Route('/shop', name: 'shop_index')]
    public function index(): Response
    {
        $products = [
            ['id' => 1, 'name' => 'T-shirt', 'description' => 'Un beau t-shirt en coton', 'price' => 19.99, 'image' => 'https://placehold.co/400x300?text=T-shirt'],
            ['id' => 2, 'name' => 'Casquette', 'description' => 'Casquette tendance pour l\'été', 'price' => 14.99, 'image' => 'https://placehold.co/400x300?text=Casquette'],
            ['id' => 3, 'name' => 'Chaussures', 'description' => 'Chaussures confortables et stylées', 'price' => 49.99, 'image' => 'https://placehold.co/400x300?text=Chaussures'],
        ];

        return $this->render('shop/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/shop/{categorie_name}', name: 'shop_list_by_categorie')]
    public function listParCategorie(#[MapEntity(expr: 'repository.findOneBy({"nom": categorie_name})')] ?Categorie $categorie) : Response
    {
        if ($categorie === null) {
            return $this->redirectToRoute('shop_index');
        }

        return $this->render('shop/list_by_categorie.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    #[Route('/shop/product/{produit_name}', name: 'shop_produit_show')]
    public function showProduit(#[MapEntity(expr: 'repository.findOneBy({"nom": produit_name})')] ?Produit $produit) : Response
    {
        if ($produit === null) {
            return $this->redirectToRoute('shop_index');
        }

        return $this->render('shop/show_produit.html.twig', [
            'product' => $produit,
        ]);
    }
}
