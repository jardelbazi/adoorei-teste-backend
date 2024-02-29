<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

class CollectionPaginator
{
    /**
     * @param array $items
     * @return LengthAwarePaginator
     */
    public static function paginate(array $items): LengthAwarePaginator
    {
        $perPage = request()->query('perPage', 15);
        $currentPage = request()->query('page', 1);

        $begin = ($currentPage - 1) * $perPage;

        $collection = collect($items)->slice($begin, $perPage);

        return new LengthAwarePaginator(
            items: $collection,
            total: count($items),
            currentPage: $currentPage,
            perPage: $perPage,
            options: [
                'path' => request()->url(),
                'query' => [
                    'page' => $currentPage,
                ],
            ]
        );
    }
}
