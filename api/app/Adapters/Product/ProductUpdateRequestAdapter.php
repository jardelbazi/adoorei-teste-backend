<?php

namespace App\Adapters\Product;

use App\DTO\Product\ProductUpdateDTO;
use Illuminate\Http\Request;

class ProductUpdateRequestAdapter extends ProductUpdateDTO
{
    public function __construct(
        private Request $request,
    ) {
        parent::__construct(
            id: $this->request->route('id'),
            name: $this->request->input('name'),
            price: $this->request->input('price'),
            description: $this->request->input('description'),
        );
    }
}
