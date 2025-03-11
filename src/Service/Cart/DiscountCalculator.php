<?php

namespace App\Service\Cart;

/**
 * Calculates discounts for the cart based on various rules.
 * Returns a negative value to reduce the total price.
 */
class DiscountCalculator implements CartCalculatorInterface
{
    private float $volumeDiscountThreshold;
    private float $volumeDiscountRate;
    private float $premiumCustomerDiscountRate;

    /**
     * @param float $volumeDiscountThreshold Minimum cart value to qualify for volume discount
     * @param float $volumeDiscountRate Discount rate for volume purchases (0.05 = 5%)
     * @param float $premiumCustomerDiscountRate Additional discount for premium customers (0.10 = 10%)
     */
    public function __construct(
        float $volumeDiscountThreshold = 100.0,
        float $volumeDiscountRate = 0.05,
        float $premiumCustomerDiscountRate = 0.10
    ) {
        $this->volumeDiscountThreshold = $volumeDiscountThreshold;
        $this->volumeDiscountRate = $volumeDiscountRate;
        $this->premiumCustomerDiscountRate = $premiumCustomerDiscountRate;
    }

    /**
     * Calculate discount amount based on cart subtotal and customer status.
     * Returns a negative value to reduce the total price.
     * 
     * {@inheritdoc}
     */
    public function calculate(Cart $cart): float
    {
        $subtotal = $cart->getSubtotal();
        $discount = 0.0;

        // Apply volume discount if cart value exceeds threshold
        if ($subtotal >= $this->volumeDiscountThreshold) {
            $discount += $subtotal * $this->volumeDiscountRate;
        }

        // Apply additional discount for premium customers
        if ($cart->isPremiumCustomer()) {
            $discount += $subtotal * $this->premiumCustomerDiscountRate;
        }

        // Return negative value to reduce the total
        return -$discount;
    }
} 