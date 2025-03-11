<?php

namespace App\Controller;

use App\Service\Cart\Cart;
use App\Service\Cart\CartCalculator;
use App\Service\Cart\CartItem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class CartController
{
    public function __construct(private readonly CartCalculator $cartCalculator)
    {
    }


    // Real world would get this cart from some requests, save it in db etc.
    #[Route('/calculate')]
    public function calculate()
    {
        // Create a cart for a German customer
        $cart = new Cart('DE', false);

        // Add some items to the cart
        $cart->addItem(new CartItem('p1', 'Smartphone', 499.99, 1, 'electronics'));
        $cart->addItem(new CartItem('p2', 'Headphones', 79.99, 1, 'electronics'));
        $cart->addItem(new CartItem('p3', 'T-Shirt', 19.99, 2, 'clothing'));

        return new JsonResponse([
            'amount' => $this->cartCalculator->calculateTotal($cart),
        ]);
    }
}
