<?php

namespace App\Repositories\Sale;

use App\Adapters\Sale\SaleRowAdapter;
use App\DTO\Sale\Product\SaleProductDTO;
use App\DTO\Sale\SaleDTO;
use App\DTO\Sale\SaleFilterDTO;
use App\DTO\Sale\SaleUpdateDTO;
use App\Enums\SaleStatusEnums;
use App\Interpreters\Sale\DeletedAtFilterSaleDbInterpreter;
use App\Interpreters\Sale\IdFilterSaleDbInterpreter;
use App\Models\Sale;
use App\Traits\BaseRepositoryTrait;

class SaleRepository implements SaleRepositoryInterface
{
    use BaseRepositoryTrait;

    public function __construct(
        protected Sale $model
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function create(SaleDTO $data): SaleUpdateDTO
    {
        $sale = $this->model->create($data->toArray());
        $this->setSaleProduct($sale, $data->getProducts());

        return SaleRowAdapter::of($sale);
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(SaleUpdateDTO $data): SaleUpdateDTO
    {
        $sale = $this->model
            ->where('id', $data->getId())
            ->where('status', '<>', SaleStatusEnums::CANCELED->value)
            ->firstOrFail();

        $this->setSaleProduct($sale, $data->getProducts());

        return SaleRowAdapter::of($sale, true);
    }

    /**
     * {@inheritdoc}
     */
    public function cancelSale(SaleFilterDTO $filter): SaleUpdateDTO
    {
        $sale = $this->model
            ->where('id', $filter->id())
            ->where('status', '<>', SaleStatusEnums::CANCELED->value)
            ->firstOrFail();

        $sale->update(['status' => SaleStatusEnums::CANCELED->value]);

        return SaleRowAdapter::of($sale);
    }

    /**
     * {@inheritdoc}
     */
    public function getOneBy(SaleFilterDTO $filter): SaleUpdateDTO
    {
        return SaleRowAdapter::of(
            $this->getQuery([
                new IdFilterSaleDbInterpreter($filter),
                new DeletedAtFilterSaleDbInterpreter($filter),
            ])->firstOrFail()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(?SaleFilterDTO $filter = null): array
    {
        $sales = $this->getQuery([
            new DeletedAtFilterSaleDbInterpreter($filter),
        ])->get();

        if (blank($sales))
            return [];

        return SaleRowAdapter::collection($sales);
    }

    /**
     * @param Sale $sale
     * @param SaleProductDTO[] $products
     * @return void
     */
    private function setSaleProduct(Sale $sale, array $products): void
    {
        $dataToSync = [];
        foreach ($products as $product) {
            $dataToSync[$product->getProductId()] = [
                'amount' => $product->getAmount(),
                'price' => $product->getPrice(),
                'deleted_at' => null,
            ];
        }

        $sale->products()->attach($dataToSync);
    }
}
