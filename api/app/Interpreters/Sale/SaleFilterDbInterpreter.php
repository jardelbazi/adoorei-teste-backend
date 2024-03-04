<?php

namespace App\Interpreters\Sale;

use App\DTO\Sale\SaleFilterDTO;
use App\Helpers\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

abstract class SaleFilterDbInterpreter extends DbInterpreter
{
    public function __construct(
        protected SaleFilterDTO $filter,
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function interpret(): Builder
    {
        return parent::interpret();
    }
}
