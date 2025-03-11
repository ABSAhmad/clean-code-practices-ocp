<?php

namespace App\Service\Cart;

/**
 * Calculates shipping costs for the cart based on country and cart value.
 */
class ShippingCalculator implements CartCalculatorInterface
{
    /** @var array<string, float> Base shipping rates by country code */
    private array $shippingRates;
    
    /** @var float Minimum cart value for free shipping */
    private float $freeShippingThreshold;

    /**
     * @param array<string, float> $shippingRates Base shipping rates by country
     */
    public function __construct(array $shippingRates = [])
    {
        // Default shipping rates if none provided
        $this->shippingRates = $shippingRates ?: [
            'DE' => 4.99,  // Germany
            'FR' => 7.99,  // France
            'UK' => 9.99,  // United Kingdom
            'US' => 14.99, // United States
        ];
    }

    /**
     * Calculate shipping cost based on the cart's country code and total value.
     * 
     * {@inheritdoc}
     */
    public function calculate(Cart $cart): float
    {
        // Free shipping for premium customers
        if ($cart->isPremiumCustomer()) {
            return 0.0;
        }
        
        $countryCode = $cart->getCountryCode();
        return $this->shippingRates[$countryCode] ?? 9.99; // Default shipping rate if country not found
    }
} 