<?php

namespace App\Repositories\Product;

use App\Adapters\Product\ProductRowAdapter;
use App\DTO\Product\ProductDTO;
use App\DTO\Product\ProductFilterDTO;
use App\DTO\Product\ProductUpdateDTO;
use App\Interpreters\Product\DeletedAtFilterProductDbInterpreter;
use App\Interpreters\Product\IdFilterProductDbInterpreter;
use App\Models\Product;
use App\Traits\BaseRepositoryTrait;

class ProductRepository implements ProductRepositoryInterface
{
    use BaseRepositoryTrait;

    public function __construct(
        protected Product $model
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function create(ProductDTO $data): ProductUpdateDTO
    {
        return ProductRowAdapter::of(
            $this->model->create($data->toArray())
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update(ProductUpdateDTO $data): ProductUpdateDTO
    {
        $product = $this->model->findOrFail($data->getId());
        $product->update($data->toArray());

        return ProductRowAdapter::of($product);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ProductFilterDTO $filter): void
    {
        $this->getQuery([
            new IdFilterProductDbInterpreter($filter),
        ])->firstOrFail()->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function getOneBy(ProductFilterDTO $filter): ProductUpdateDTO
    {
        return ProductRowAdapter::of(
            $this->getQuery([
                new IdFilterProductDbInterpreter($filter),
                new DeletedAtFilterProductDbInterpreter($filter),
            ])->firstOrFail()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(?ProductFilterDTO $filter = null): array
    {
        $products = $this->getQuery([
            new DeletedAtFilterProductDbInterpreter($filter),
        ])->get();

        if (blank($products))
            return [];

        return ProductRowAdapter::collection($products);
    }
}
