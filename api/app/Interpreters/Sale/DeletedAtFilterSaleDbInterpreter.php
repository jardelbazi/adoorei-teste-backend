<?php

namespace App\Interpreters\Sale;
use Illuminate\Database\Eloquent\Builder;

class DeletedAtFilterSaleDbInterpreter extends SaleFilterDbInterpreter
{
    /**
     * {@inheritdoc}
     */
    public function interpret(): Builder
    {
        $deleted = $this->filter->deleted();

        if (blank($deleted))
            return $this->query;

        return $this->query->withTrashed();
    }
}
