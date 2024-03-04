<?php

namespace App\Http\Resources;

use App\DTO\Sale\SaleUpdateDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var SaleUpdateDTO */
        $sale = $this->resource;
        $data = $sale->toArray();

        $data['products'] = SaleProductResource::collection($sale->getProducts());

        return $data;
    }
}
