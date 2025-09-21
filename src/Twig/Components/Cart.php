<?php

namespace App\Twig\Components;

use App\Service\CartService;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Cart
{
    public int $iTotal;
    public function __construct(private readonly CartService $cartService) {
        $this->iTotal = $this->cartService->getTotalQuantity();
    }
}
