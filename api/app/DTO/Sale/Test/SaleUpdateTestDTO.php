<?php

namespace App\DTO\Sale\Test;

use App\DTO\Sale\SaleUpdateDTO;

class SaleUpdateTestDTO extends SaleUpdateDTO
{
    public function __construct(
        protected int $id,
        array $products,
        ?string $status = null,
        ?string $sale_id = null,
        ?float $amount = null,
    ) {
        parent::__construct(
            id: $id,
            products: $products,
            sale_id: $sale_id,
            amount: $amount,
            status: $status,
        );
    }
}
