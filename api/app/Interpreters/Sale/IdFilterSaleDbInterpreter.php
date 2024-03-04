<?php

namespace App\Interpreters\Sale;
use Illuminate\Database\Eloquent\Builder;

class IdFilterSaleDbInterpreter extends SaleFilterDbInterpreter
{
    /**
     * {@inheritdoc}
     */
    public function interpret(): Builder
    {
        $id = $this->filter->id();

        if (blank($id))
            return $this->query;

        return $this->query->where('id', $id);
    }
}
