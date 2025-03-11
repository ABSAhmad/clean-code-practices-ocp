<?php

namespace App\Service\Cart;

/**
 * Represents a shopping cart with items.
 */
class Cart
{
    /** @var CartItem[] */
    private array $items = [];
    
    private string $countryCode;
    
    private bool $isPremiumCustomer;

    /**
     * @param string $countryCode ISO country code
     * @param bool $isPremiumCustomer Whether the customer has premium status
     */
    public function __construct(string $countryCode = 'DE', bool $isPremiumCustomer = false)
    {
        $this->countryCode = $countryCode;
        $this->isPremiumCustomer = $isPremiumCustomer;
    }

    /**
     * Add an item to the cart.
     */
    public function addItem(CartItem $item): void
    {
        $this->items[] = $item;
    }

    /**
     * Get all items in the cart.
     *
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Calculate the subtotal of all items in the cart.
     */
    public function getSubtotal(): float
    {
        $subtotal = 0.0;
        foreach ($this->items as $item) {
            $subtotal += $item->getPrice() * $item->getQuantity();
        }
        return $subtotal;
    }

    /**
     * Get the country code for this cart.
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * Check if the customer has premium status.
     */
    public function isPremiumCustomer(): bool
    {
        return $this->isPremiumCustomer;
    }
} 