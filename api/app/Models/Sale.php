<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'status',
        'sale_id',
        'amount',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'sale_products')
            ->using(SaleProduct::class)
            ->withTimestamps()
            ->withPivot([
                'amount',
                'price',
                'deleted_at',
            ])
            ->withTrashed();
    }
}
