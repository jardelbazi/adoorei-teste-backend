<?php

namespace App\Adapters\Product;

use App\DTO\Product\ProductFilterDTO;
use Illuminate\Http\Request;

class ProductFilterRequestAdapter extends ProductFilterDTO
{
    public function __construct(
        private Request $request,
    ) {
        parent::__construct(
            id: $this->request->route('id'),
            deleted: $this->request->query('deleted'),
        );
    }
}
