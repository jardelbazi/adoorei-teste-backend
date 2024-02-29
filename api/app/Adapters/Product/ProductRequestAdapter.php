<?php

namespace App\Adapters\Product;

use App\DTO\Product\ProductDTO;
use Illuminate\Http\Request;

class ProductRequestAdapter extends ProductDTO
{
    public function __construct(
        private Request $request,
    ) {
        parent::__construct(
            name: $this->request->input('name'),
            price: $this->request->input('price'),
            description: $this->request->input('description'),
        );
    }
}
