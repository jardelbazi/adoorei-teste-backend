<?php

namespace App\Interpreters\Product;

use App\DTO\Product\ProductFilterDTO;
use App\Helpers\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

abstract class ProductFilterDbInterpreter extends DbInterpreter
{
    public function __construct(
        protected ProductFilterDTO $filter,
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
