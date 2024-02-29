<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;

trait BaseRepositoryTrait
{
    /**
     * @param array $interpreters
     * @return Builder
     */
    public function getQuery(array $interpreters, ?array $with = []): Builder
    {
        $query = $this->model->query();

        foreach ($interpreters as $interpreter) {
            $query = $interpreter
                ->setQuery($query)
                ->interpret();
        }

        return $query;
    }

}
