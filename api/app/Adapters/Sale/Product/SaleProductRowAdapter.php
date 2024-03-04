<?php

namespace App\Adapters\Sale\Product;

use App\DTO\Sale\Product\SaleProductDTO;
use App\Models\Product;
use App\Traits\RowAdapterTrait;

class SaleProductRowAdapter extends SaleProductDTO
{
    use RowAdapterTrait;

    public function __construct(
        private Product $model,
    ) {
        parent::__construct(
            product_id: $this->model->pivot->product_id,
            sale_id: $this->model->pivot->sale_id,
            amount: $this->model->pivot->amount,
            price: $this->model->price,
            name: $this->model->name,
        );
    }
}
