<?php

namespace App\Services\Product;

use App\DTO\Product\ProductDTO;
use App\DTO\Product\ProductFilterDTO;
use App\DTO\Product\ProductUpdateDTO;

interface ProductServiceInterface
{
    /**
     * @param ProductDTO $data
     * @return ProductUpdateDTO
     */
    public function create(ProductDTO $data): ProductUpdateDTO;

    /**
     * @param ProductUpdateDTO $data
     * @return ProductUpdateDTO
     */
    public function update(ProductUpdateDTO $data): ProductUpdateDTO;

    /**
     * @param ProductFilterDTO $filter
     * @return void
     */
    public function delete(ProductFilterDTO $filter): void;

    /**
     * @param ProductFilterDTO $filter
     * @return ProductUpdateDTO
     */
    public function getOneBy(ProductFilterDTO $filter): ProductUpdateDTO;

    /**
     * @param null|ProductFilterDTO $filter
     * @return array
     */
    public function getAll(?ProductFilterDTO $filter = null): array;

    /**
     * @param int $id
     * @return ProductUpdateDTO
     */
    public function getById(int $id): ProductUpdateDTO;
}
