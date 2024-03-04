<?php

namespace App\DTO\Sale\Product\Test;

use App\DTO\Sale\Product\SaleProductDTO;

class SaleProductTestDTO extends SaleProductDTO
{
    public function __construct(
        int $product_id,
        int $amount,
        ?float $price = null,
        ?int $sale_id = null,
        ?string $name = null,
    ) {
        parent::__construct(
            product_id: $product_id,
            sale_id: $sale_id,
            amount: $amount,
            price: $price,
            name: $name,
        );
    }
}
