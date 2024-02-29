<?php

namespace App\Services\Product;

use App\DTO\Product\ProductDTO;
use App\DTO\Product\ProductFilterDTO;
use App\DTO\Product\ProductUpdateDTO;
use App\Repositories\Product\ProductRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
    ) {
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function create(ProductDTO $data): ProductUpdateDTO
    {
        DB::beginTransaction();

        try {
            $product = $this->productRepository->create($data);
            DB::commit();
            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Falha ao inserir:' . $e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     * @throws ModelNotFoundException
     * @throws Exception
     */
    public function update(ProductUpdateDTO $data): ProductUpdateDTO
    {
        DB::beginTransaction();

        try {
            $product =  $this->productRepository->update($data);
            DB::commit();
            return $product;
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw new ModelNotFoundException($e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Falha ao atualizar:' . $e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     * @throws ModelNotFoundException
     * @throws Exception
     */
    public function delete(ProductFilterDTO $filter): void
    {
        DB::beginTransaction();

        try {
            $this->productRepository->delete($filter);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw new ModelNotFoundException($e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Falha ao deletar:' . $e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOneBy(ProductFilterDTO $filter): ProductUpdateDTO
    {
        return $this->productRepository->getOneBy($filter);
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(?ProductFilterDTO $filter = null): array
    {
        return $this->productRepository->getAll($filter);
    }
}
