<?php

namespace App\Service\Cart;

/**
 * Main cart calculator service that follows the Open/Closed Principle.
 * This class is open for extension (by adding new calculator implementations)
 * but closed for modification (the calculate method doesn't need to change).
 */
class CartCalculator
{
    /** @var CartCalculatorInterface[] */
    private array $calculators;

    /**
     * Constructor that accepts an array of calculator implementations.
     * This is where dependency injection happens.
     *
     * @param CartCalculatorInterface[] $calculators
     */
    public function __construct(iterable $calculators)
    {
        $this->calculators = $calculators instanceof \Traversable ? iterator_to_array($calculators) : $calculators;
    }

    /**
     * Calculate the final price of the cart by applying all registered calculators.
     * The base price is the cart subtotal, and each calculator can add or subtract from it.
     */
    public function calculateTotal(Cart $cart): float
    {
        $total = $cart->getSubtotal();

        // Apply each calculator to the total
        foreach ($this->calculators as $calculator) {
            $total += $calculator->calculate($cart);
        }

        return max(0, $total); // Ensure the total is never negative
    }
} 