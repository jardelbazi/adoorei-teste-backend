<?php

namespace App\Interpreters\Product;
use Illuminate\Database\Eloquent\Builder;

class DeletedAtFilterProductDbInterpreter extends ProductFilterDbInterpreter
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
