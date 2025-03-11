<?php

namespace App\Service\Cart;

/**
 * Calculates tax for the cart based on the country.
 */
class TaxCalculator implements CartCalculatorInterface
{
    /** @var array<string, float> Tax rates by country code */
    private array $taxRates;

    /**
     * @param array<string, float> $taxRates Tax rates by country code (e.g., ['DE' => 0.19, 'FR' => 0.20])
     */
    public function __construct(array $taxRates = [])
    {
        // Default tax rates if none provided
        $this->taxRates = $taxRates ?: [
            'DE' => 0.19, // Germany: 19%
            'FR' => 0.20, // France: 20%
            'UK' => 0.20, // United Kingdom: 20%
            'US' => 0.0,  // United States: varies by state, simplified to 0 for example
        ];
    }

    /**
     * Calculate tax amount based on the cart's country code.
     * 
     * {@inheritdoc}
     */
    public function calculate(Cart $cart): float
    {
        $countryCode = $cart->getCountryCode();
        $taxRate = $this->taxRates[$countryCode] ?? 0.0;
        
        return $cart->getSubtotal() * $taxRate;
    }
} 