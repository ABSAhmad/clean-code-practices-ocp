<?php

namespace App\Service\Cart;

/**
 * Calculates seasonal discounts for the cart.
 * This is an example of extending the system without modifying existing code.
 * Returns a negative value to reduce the total price.
 */
class SeasonalDiscountCalculator implements CartCalculatorInterface
{
    private bool $isHolidaySeason;
    private float $seasonalDiscountRate;
    private array $seasonalProductCategories;

    /**
     * @param bool $isHolidaySeason Whether it's currently a holiday season
     * @param float $seasonalDiscountRate Discount rate for seasonal items (0.15 = 15%)
     * @param array $seasonalProductCategories Product categories eligible for seasonal discount
     */
    public function __construct(
        bool $isHolidaySeason = false,
        float $seasonalDiscountRate = 0.15,
        array $seasonalProductCategories = ['toys', 'electronics', 'clothing']
    ) {
        $this->isHolidaySeason = $isHolidaySeason;
        $this->seasonalDiscountRate = $seasonalDiscountRate;
        $this->seasonalProductCategories = $seasonalProductCategories;
    }

    /**
     * Calculate seasonal discount amount.
     * Returns a negative value to reduce the total price.
     * 
     * {@inheritdoc}
     */
    public function calculate(Cart $cart): float
    {
        // No seasonal discount if it's not holiday season
        if (!$this->isHolidaySeason) {
            return 0.0;
        }

        $discount = 0.0;

        // Apply discount only to eligible product categories
        foreach ($cart->getItems() as $item) {
            if (in_array($item->getCategory(), $this->seasonalProductCategories)) {
                $discount += $item->getPrice() * $item->getQuantity() * $this->seasonalDiscountRate;
            }
        }

        // Return negative value to reduce the total
        return -$discount;
    }
} 