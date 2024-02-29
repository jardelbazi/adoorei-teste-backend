<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

abstract class DbInterpreter
{
    protected Builder $query;

    /**
     * @return Builder
     */
    abstract public function interpret(): Builder;

    /**
     *
     * @param Builder $query
     * @return DbInterpreter
     */
    public function setQuery(Builder $query): self
    {
        $this->query = $query;

        return $this;
    }
}
