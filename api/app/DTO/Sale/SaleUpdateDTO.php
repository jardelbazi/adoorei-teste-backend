<?php

namespace App\DTO\Sale;

use App\DTO\UpdateDTO;
use App\Traits\UpdateDTOTrait;

abstract class SaleUpdateDTO extends SaleDTO implements UpdateDTO
{
    use UpdateDTOTrait;

    public function __construct(
        protected int $id,
        array $products,
        string $status,
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
