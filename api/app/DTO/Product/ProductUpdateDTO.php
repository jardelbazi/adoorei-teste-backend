<?php

namespace App\DTO\Product;

use App\DTO\UpdateDTO;
use App\Traits\UpdateDTOTrait;

abstract class ProductUpdateDTO extends ProductDTO implements UpdateDTO
{
    use UpdateDTOTrait;

    public function __construct(
        protected int $id,
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
