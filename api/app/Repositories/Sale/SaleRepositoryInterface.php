<?php

namespace App\Repositories\Sale;

use App\DTO\Sale\SaleDTO;
use App\DTO\Sale\SaleFilterDTO;
use App\DTO\Sale\SaleUpdateDTO;

interface SaleRepositoryInterface
{
    /**
     * @param SaleDTO $data
     * @return SaleUpdateDTO
     */
    public function create(SaleDTO $data): SaleUpdateDTO;

    /**
     * @param SaleUpdateDTO $data
     * @return SaleUpdateDTO
     */
    public function addItem(SaleUpdateDTO $data): SaleUpdateDTO;

    /**
     * @param SaleFilterDTO $filter
     * @return SaleUpdateDTO
     */
    public function cancelSale(SaleFilterDTO $filter): SaleUpdateDTO;

    /**
     * @param SaleFilterDTO $filter
     * @return SaleUpdateDTO
     */
    public function getOneBy(SaleFilterDTO $filter): SaleUpdateDTO;

    /**
     * @param null|SaleFilterDTO $filter
     * @return array
     */
    public function getAll(?SaleFilterDTO $filter = null): array;
}
