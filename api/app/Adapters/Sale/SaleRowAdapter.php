<?php

namespace App\Adapters\Sale;

use App\Adapters\Sale\Product\SaleProductRowAdapter;
use App\DTO\Sale\SaleUpdateDTO;
use App\Models\Sale;
use App\Traits\RowAdapterTrait;

class SaleRowAdapter extends SaleUpdateDTO
{
    use RowAdapterTrait;

    public function __construct(
        private Sale $model,
    ) {
        parent::__construct(
            id: $this->model->id,
            status: $this->model->status,
            sale_id: $this->model->sale_id,
            amount: $this->model->amount,
            products: SaleProductRowAdapter::collection($this->model->products),
        );
    }
}
