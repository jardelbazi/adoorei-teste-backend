<?php

namespace App\DTO\Product;

use Illuminate\Contracts\Support\Arrayable;

abstract class ProductDTO implements Arrayable
{
    public function __construct(
        protected string $name,
        protected float $price,
        protected string $description,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'description' => $this->getDescription(),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
