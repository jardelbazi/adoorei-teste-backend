<?php

namespace App\DTO\Product\Test;

use App\DTO\Product\ProductDTO;

class ProductTestDTO extends ProductDTO
{
    public function __construct(
        string $name,
        float $price,
        string $description,
    ) {
        parent::__construct(
            name: $name,
            price: $price,
            description: $description,
        );
    }
}
