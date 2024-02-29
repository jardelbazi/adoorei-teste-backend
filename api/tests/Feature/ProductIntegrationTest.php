<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductIntegrationTest extends TestCase
{
    use DatabaseMigrations, WithoutMiddleware;

    const ENDPOINT = '/api/products/';
    const TABLE_NAME = 'products';

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
            'name',
            'price',
            'description',
        ];
    }

    /** @test */
    public function it_can_create_a_product(): void
    {
        $createAttributes = [
            'name' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 0, 1000),
            'description' => fake()->text(),
        ];

        $response = $this->postJson(self::ENDPOINT, $createAttributes);

        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure($this->getJsonStructure());

        $this->assertDatabaseHas(SELF::TABLE_NAME, $createAttributes);
    }

    /** @test */
    public function it_can_update_a_product()
    {
        $product = Product::factory()->create();

        $updatedAttributes = [
            'name' => $product->name,
            'price' => fake()->randomFloat(2, 0, 1000),
            'description' => $product->description,
        ];

        $response = $this->putJson(self::ENDPOINT . $product->id, $updatedAttributes);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($this->getJsonStructure());

        $this->assertDatabaseHas(SELF::TABLE_NAME, $updatedAttributes);
    }

    /** @test */
    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson(self::ENDPOINT . $product->id);

        $response
            ->assertStatus(Response::HTTP_NO_CONTENT)
            ->assertNoContent();

        $this->assertSoftDeleted($product);
    }

    /** @test */
    public function it_can_show_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson(self::ENDPOINT . $product->id);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($this->getJsonStructure());
    }

    /** @test */
    public function it_can_not_show_a_product(): void
    {
        $invalidId = 999;
        $this->withExceptionHandling();

        $response = $this->getJson(self::ENDPOINT . $invalidId);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function it_can_show_all_products()
    {
        Product::factory(10)->create();

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
    public function it_can_show_all_products_with_trashed()
    {
        $products = Product::factory(10)->create();
        $products[0]->delete();
        $products[1]->delete();

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
