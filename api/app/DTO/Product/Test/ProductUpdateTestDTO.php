<?php

namespace App\DTO\Product\Test;

use App\DTO\Product\ProductUpdateDTO;

class ProductUpdateTestDTO extends ProductUpdateDTO
{
    public function __construct(
        protected int $id,
        string $name,
        float $price,
        string $description,
    ) {
        parent::__construct(
            id: $id,
            name: $name,
            price: $price,
            description: $description,
        );
    }
}
