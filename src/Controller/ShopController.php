<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
}
