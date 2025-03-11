<?php

namespace App\Service\Cart;

/**
 * Interface for cart calculators following the Open/Closed Principle.
 * New calculation strategies can be added without modifying existing code.
 */
interface CartCalculatorInterface
{
    /**
     * Calculate a specific aspect of the cart (e.g., tax, discount, shipping).
     *
     * @param Cart $cart The cart to calculate for
     * @return float The calculated amount
     */
    public function calculate(Cart $cart): float;
} 