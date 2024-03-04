<?php

namespace App\Adapters\Sale;

use App\Adapters\Sale\Product\SaleProductRequestAdapter;
use App\DTO\Sale\SaleDTO;
use App\Enums\SaleStatusEnums;
use Illuminate\Http\Request;

class SaleRequestAdapter extends SaleDTO
{
    public function __construct(
        private Request $request,
    ) {
        parent::__construct(
            products: SaleProductRequestAdapter::collectionFromArrayAnotherRequest($this->request->input('products')),
            status: SaleStatusEnums::PENDING->value,
        );
    }
}
