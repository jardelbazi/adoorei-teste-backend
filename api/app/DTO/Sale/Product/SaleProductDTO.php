<?php

namespace App\DTO\Sale\Product;

use App\Services\Product\ProductServiceInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\App;

abstract class SaleProductDTO implements Arrayable
{
    public function __construct(
        protected int $product_id,
        protected int $amount,
        protected ?float $price = null,
        protected ?int $sale_id = null,
        protected ?string $name = null,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'product_id' => $this->getProductId(),
            'name' => $this->getName(),
            'sale_id' => $this->getSailId(),
            'amount' => $this->getAmount(),
            'price' => $this->getPrice(),
        ];
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @return null|int
     */
    public function getSailId(): ?int
    {
        return $this->sale_id;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this
            ->getProductService()
            ->getById($this->getProductId())
            ->getPrice();
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return ProductServiceInterface
     */
    public function getProductService(): ProductServiceInterface
    {
        return App::make(ProductServiceInterface::class);
    }
}
