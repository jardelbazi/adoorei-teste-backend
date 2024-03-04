<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => function() {
                return Product::factory()->create()->id;
            },
            'sale_id' => function() {
                return Sale::factory()->create()->id;
            },
            'amount' => fake()->numberBetween(1,3),
            'price' => fake()->randomFloat(2, 0, 1000),
        ];
    }
}
