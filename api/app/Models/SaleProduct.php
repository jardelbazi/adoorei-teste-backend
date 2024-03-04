<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleProduct extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $table = 'sale_products';

    protected $fillable = [
        'product_id',
        'sale_id',
        'amount',
        'price',
    ];
}
