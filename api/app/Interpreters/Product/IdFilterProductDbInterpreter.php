<?php

namespace App\Interpreters\Product;
use Illuminate\Database\Eloquent\Builder;

class IdFilterProductDbInterpreter extends ProductFilterDbInterpreter
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
