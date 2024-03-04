<?php

namespace App\DTO\Sale\Test;

use App\DTO\Sale\SaleDTO;

class SaleTestDTO extends SaleDTO
{
    public function __construct(
        array $products,
        ?string $status = null,
        ?string $sale_id = null,
        ?float $amount = null,
    ) {
        parent::__construct(
            products: $products,
            sale_id: $sale_id,
            amount: $amount,
            status: $status,
        );
    }
}
