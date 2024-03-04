<?php

namespace App\Services\Sale;

use App\DTO\Sale\SaleDTO;
use App\DTO\Sale\SaleFilterDTO;
use App\DTO\Sale\SaleUpdateDTO;
use App\Repositories\Sale\SaleRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class SaleService implements SaleServiceInterface
{
    public function __construct(
        private SaleRepositoryInterface $saleRepository,
    ) {
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function create(SaleDTO $data): SaleUpdateDTO
    {
        DB::beginTransaction();

        try {
            $sale = $this->saleRepository->create($data);
            DB::commit();
            return $sale;
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
    public function addItem(SaleUpdateDTO $data): SaleUpdateDTO
    {
        DB::beginTransaction();

        try {
            $sale = $this->saleRepository->addItem($data);
            DB::commit();
            return $sale;
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
    public function cancelSale(SaleFilterDTO $filter): SaleUpdateDTO
    {
        DB::beginTransaction();

        try {
            $sale = $this->saleRepository->cancelSale($filter);
            DB::commit();
            return $sale;
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
     */
    public function getOneBy(SaleFilterDTO $filter): SaleUpdateDTO
    {
        return $this->saleRepository->getOneBy($filter);
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(?SaleFilterDTO $filter = null): array
    {
        return $this->saleRepository->getAll($filter);
    }
}
