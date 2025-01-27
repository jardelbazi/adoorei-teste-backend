<?php

namespace App\Http\Resources;

use App\DTO\Product\ProductlUpdateDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var ProductlUpdateDTO */
        $product = $this->resource;
        return $product->toArray();
    }
}
