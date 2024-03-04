<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait RequestAdapterTrait
{
    /**
     * @param null|array $data
     * @return null|self
     */
    public static function fromArrayAnotherRequest(?array $data = null): ?self
    {
        if (blank($data))
            return null;

        return new self(new Request(query: $data));
    }

    public static function collectionFromArrayAnotherRequest(array $data): array
    {
        $toRequestItem = fn (array $item) => new Request(query: $item);

        return collect($data)
            ->map($toRequestItem)
            ->mapInto(self::class)->all();
    }
}
