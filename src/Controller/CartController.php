<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_index')]
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    #[Route('/cart/add', name: 'cart_add', methods: ['POST'])]
    public function add(Request $request, ProduitRepository $produitRepository, CartService $cartService): Response
    {
        $idProduit = $request->request->getInt('produit');
        $iQte = $request->request->getInt('quantity', 1);
        $produit = $produitRepository->find($idProduit);

        if (! $produit) {
            return $this->redirectToRoute('cart_index');
        }

        $cartService->add($produit, $iQte);

        $this->addFlash('success', sprintf(
            'Le produit %s a bien été ajouté au panier.',
            $produit->getNom()
        ));

        $returnUrl = $request->request->get('return_url');
        return $returnUrl
            ? $this->redirect($returnUrl)
            : $this->redirectToRoute('app_home');
    }
}
