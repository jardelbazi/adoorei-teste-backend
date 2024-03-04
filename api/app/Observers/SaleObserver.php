<?php

namespace App\Observers;

use App\Models\Sale;
use Illuminate\Support\Str;

class SaleObserver
{
    public function creating(Sale $sale): void
    {
        $sale->sale_id = Str::uuid();
    }
}
