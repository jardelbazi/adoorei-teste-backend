<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\TestCase;

class SaleIntegrationTest extends TestCase
{
    use DatabaseMigrations, WithoutMiddleware;

    const ENDPOINT = '/api/sales/';
    const TABLE_NAME = 'sales';

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /**
     * @return array
     */
    public function getJsonStructure(): array
    {
        return [
            'id',
            'status',
            'sale_id',
            'amount',
            'products',
        ];
    }

    /** @test */
    public function it_can_create_a_sale(): void
    {
        $products = Product::factory(3)->create();

        foreach ($products as $product) {
            $createAttributes['products'][] = [
                'product_id' => $product->id,
                'amount' => fake()->numberBetween(1, 3),
            ];
        }

        $response = $this->postJson(self::ENDPOINT, $createAttributes);

        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure($this->getJsonStructure());

        unset($createAttributes['products']);

        $this->assertDatabaseHas(SELF::TABLE_NAME, $createAttributes);
    }

    /** @test */
    public function it_can_add_product_a_sale()
    {
        $sale = Sale::factory()->create();
        $product = Product::factory()->create();

        $addAttribute['products'][] = [
            'product_id' => $product->id,
            'amount' => fake()->numberBetween(1, 3),
        ];

        $response = $this->patchJson(self::ENDPOINT . 'add-item/' . $sale->id, $addAttribute);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($this->getJsonStructure());

        unset($addAttribute['products']);

        $this->assertDatabaseHas(SELF::TABLE_NAME, $addAttribute);
    }

    /** @test */
    public function it_can_cancel_a_sale()
    {
        $sale = Sale::factory()->create();

        $response = $this->patchJson(self::ENDPOINT . 'cancel/' . $sale->id);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($this->getJsonStructure());
    }

    /** @test */
    public function it_can_show_a_sale()
    {
        $sale = Sale::factory()->create();

        $response = $this->getJson(self::ENDPOINT . $sale->id);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($this->getJsonStructure());
    }

    /** @test */
    public function it_can_not_show_a_sale(): void
    {
        $invalidId = 999;
        $this->withExceptionHandling();

        $response = $this->getJson(self::ENDPOINT . $invalidId);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function it_can_show_all_sales()
    {
        Sale::factory(10)->create();

        $response = $this->getJson(self::ENDPOINT);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    $this->getJsonStructure()
                ]
            ]);
    }

    /** @test */
    public function it_can_show_all_sales_with_trashed()
    {
        $sales = Sale::factory(10)->create();
        $sales[0]->delete();
        $sales[1]->delete();

        $response = $this->getJson(self::ENDPOINT . '?deleted=true');

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    $this->getJsonStructure()
                ]
            ]);
    }
}
