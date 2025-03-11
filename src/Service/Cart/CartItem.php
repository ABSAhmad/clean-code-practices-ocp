<?php

namespace App\Service\Cart;

/**
 * Represents an item in the shopping cart.
 */
class CartItem
{
    private string $productId;
    private string $name;
    private float $price;
    private int $quantity;
    private string $category;

    /**
     * @param string $productId Unique identifier for the product
     * @param string $name Product name
     * @param float $price Product price
     * @param int $quantity Quantity of this product in the cart
     * @param string $category Product category (e.g., 'electronics', 'clothing')
     */
    public function __construct(
        string $productId,
        string $name,
        float $price,
        int $quantity = 1,
        string $category = 'general'
    ) {
        $this->productId = $productId;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->category = $category;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
} 