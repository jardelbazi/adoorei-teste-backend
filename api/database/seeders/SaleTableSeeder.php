<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use Illuminate\Database\Seeder;

class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = fn () => Product::inRandomOrder()
            ->take(fake()->numberBetween(1, 3))
            ->get();

        Sale::factory(10)
            ->create()
            ->each(function ($sale) use ($products) {
                $amount = 0;

                foreach ($products() as $product) {
                    $quantity = fake()->numberBetween(1, 3);

                    SaleProduct::factory()->create([
                        'product_id' => $product->id,
                        'sale_id' => $sale->id,
                        'amount' => $quantity,
                        'price' => $product->price,
                    ]);
                    $amount += $product->price * $quantity;
                }
                $sale->update(['amount' => $amount]);
            });
    }
}
