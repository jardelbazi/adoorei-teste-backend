<?php

namespace App\Adapters\Sale;

use App\Adapters\Sale\Product\SaleProductRequestAdapter;
use App\DTO\Sale\SaleUpdateDTO;
use App\Enums\SaleStatusEnums;
use Illuminate\Http\Request;

class SaleUpdateRequestAdapter extends SaleUpdateDTO
{
    public function __construct(
        private Request $request,
    ) {
        parent::__construct(
            id: $this->request->route('id'),
            products: SaleProductRequestAdapter::collectionFromArrayAnotherRequest($this->request->input('products')),
            status: SaleStatusEnums::PENDING->value,
        );
    }
}
