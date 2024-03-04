<?php

namespace App\Http\Resources;

use App\DTO\Sale\Product\SaleProductDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var SaleProductDTO*/
        $sale = $this->resource;
        return $sale->toArray();
    }
}
