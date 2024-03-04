<?php

namespace App\DTO\Sale;

use App\DTO\Sale\Product\SaleProductDTO;
use Illuminate\Contracts\Support\Arrayable;

abstract class SaleDTO implements Arrayable
{
    public function __construct(
        protected array $products,
        protected string $status,
        protected ?string $sale_id = null,
        protected ?float $amount = null,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'status' => $this->getStatus(),
            'sale_id' => $this->getSaleId(),
            'amount' => $this->getAmount(),
        ];
    }

    /**
     * @return SaleProductDTO[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return null|string
     */
    public function getSaleId(): ?string
    {
        return $this->sale_id;
    }

    /**
     * @return null|float
     */
    public function getAmount(): ?float
    {
        if (blank($this->getProducts())) {
            return $this->amount;
        }

        $amount = 0;

        foreach ($this->getProducts() as $product) {
            $amount += $product->getPrice() * $product->getAmount();
        }

        return $amount;
    }
}
