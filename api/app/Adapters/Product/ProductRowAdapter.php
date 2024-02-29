<?php

namespace App\Adapters\Product;

use App\DTO\Product\ProductUpdateDTO;
use App\Models\Product;
use App\Traits\RowAdapterTrait;

class ProductRowAdapter extends ProductUpdateDTO
{
    use RowAdapterTrait;

    public function __construct(
        private Product $model,
    )
    {
        parent::__construct(
            id: $this->model->id,
            name: $this->model->name,
            price: $this->model->price,
            description: $this->model->description,
        );
    }
}
