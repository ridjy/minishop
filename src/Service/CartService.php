<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Produit;

class CartService
{
    private SessionInterface $session;
    public function __construct(RequestStack $requestStack) {
        $this->session = $requestStack->getSession();
    }

    public function add(Produit $produit, int $qte = 1): void
    {
        $cart = $this->session->get('cart', []);

        if (isset($cart[$produit->getId()])) {
            $cart[$produit->getId()]['qte'] += $qte;
        } else {
            $cart[$produit->getId()] = [
                'id'  => $produit,
                'qte' => $qte,
            ];
        }

        $this->session->set('cart', $cart);
    }

    public function getCart(): array
    {
        return $this->session->get('cart', []);
    }

    public function getTotalQuantity(): int
    {
        $cart = $this->getCart();
        return array_sum(array_column($cart, 'qte'));
    }

    public function clear(): void
    {
        $this->session->remove('cart');
    }
}
