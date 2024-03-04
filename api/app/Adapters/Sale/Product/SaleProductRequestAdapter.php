<?php

namespace App\Adapters\Sale\Product;

use App\DTO\Sale\Product\SaleProductDTO;
use App\Traits\RequestAdapterTrait;
use Illuminate\Http\Request;

class SaleProductRequestAdapter extends SaleProductDTO
{
    use RequestAdapterTrait;

    public function __construct(
        private Request $request,
    ) {
        parent::__construct(
            product_id: $this->request->input('product_id'),
            amount: $this->request->input('amount'),
        );
    }
}
