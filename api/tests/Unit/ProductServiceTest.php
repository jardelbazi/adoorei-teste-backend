<?php

namespace Tests\Unit;

use App\DTO\Product\Test\ProductTestDTO;
use App\DTO\Product\Test\ProductUpdateTestDTO;
use App\DTO\Product\Test\ProductFilterTestDTO;
use App\DTO\Product\ProductUpdateDTO;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Product\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected $productRepository;
    protected $productService;
    protected $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productRepository = $this->createMock(ProductRepositoryInterface::class);
        $this->productService = new ProductService($this->productRepository);

        $this->product = Product::factory()->create();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function it_can_create_a_product_service_test(): void
    {
        $productDTO = new ProductTestDTO(
            name: fake()->sentence(),
            price: fake()->randomFloat(2, 0, 1000),
            description: fake()->text(),
        );

        $productUpdateDTO = new ProductUpdateTestDTO(
            id: 1,
            name: $productDTO->getName(),
            price: $productDTO->getPrice(),
            description: $productDTO->getDescription(),
        );

        $this->productRepository
            ->expects($this->once())
            ->method('create')
            ->with($productDTO)
            ->willReturn($productUpdateDTO);

        $result = $this->productService->create($productDTO);

        $this->assertInstanceOf(ProductUpdateDTO::class, $result);
        $this->assertEquals($productUpdateDTO, $result);
    }

    /** @test */
    public function it_can_update_a_product_service_test(): void
    {
        $productUpdateDTO = new ProductUpdateTestDTO(
            id: $this->product->id,
            name: fake()->sentence(),
            price: fake()->randomFloat(2, 0, 1000),
            description: fake()->text(),
        );

        $this->productRepository
            ->expects($this->once())
            ->method('update')
            ->with($productUpdateDTO)
            ->willReturn($productUpdateDTO);

        $result = $this->productService->update($productUpdateDTO);

        $this->assertInstanceOf(ProductUpdateDTO::class, $result);
        $this->assertEquals($productUpdateDTO->toArray(), $result->toArray());
    }

    /** @test */
    public function it_can_delete_a_product_service_test()
    {
        $productFilter = new ProductFilterTestDTO(
            id: $this->product->id,
        );

        $this->productRepository
            ->expects($this->once())
            ->method('delete')
            ->with($productFilter);

        $result = $this->productService->delete($productFilter);

        $this->assertEmpty($result);
        $this->assertTrue(true);
    }

    /** @test */
    public function it_can_show_a_product_service_test()
    {
        $productUpdateDTO = new ProductUpdateTestDTO(
            id: $this->product->id,
            name: fake()->sentence(),
            price: fake()->randomFloat(2, 0, 1000),
            description: fake()->text(),
        );

        $productFilter = new ProductFilterTestDTO(
            id: $this->product->id,
        );

        $this->productRepository
            ->expects($this->once())
            ->method('getOneBy')
            ->with($productFilter)
            ->willReturn($productUpdateDTO);

        $result = $this->productService->getOneBy($productFilter);

        $this->assertInstanceOf(ProductUpdateDTO::class, $result);
        $this->assertEquals($productUpdateDTO, $result);
    }

    /** @test */
    public function it_can_not_show_a_product_service_test(): void
    {
        $productFilter = new ProductFilterTestDTO(
            id: 999,
        );

        $this->productRepository
            ->expects($this->once())
            ->method('getOneBy')
            ->with($productFilter)
            ->willThrowException(new ModelNotFoundException('Product not found', Response::HTTP_NOT_FOUND));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Product not found');
        $this->expectExceptionCode(Response::HTTP_NOT_FOUND);

        $this->productService->getOneBy($productFilter);
    }

    /** @test */
    public function it_can_show_all_products_service_test(): void
    {
        $products = Product::factory(10)->create();

        $this->productRepository
            ->expects($this->once())
            ->method('getAll')
            ->willReturn($products->toArray());

        $result = $this->productService->getAll();

        $this->assertCount(10, $result);
    }

    /** @test */
    public function it_can_show_all_products_with_trashed_service_test(): void
    {
        $productFilter = new ProductFilterTestDTO(
            deleted: true,
        );

        $product = Product::factory()->create();
        $productDeleted = Product::factory()->create(['deleted_at' => now()]);

        $products = collect([$product, $productDeleted]);

        $this->productRepository
            ->expects($this->once())
            ->method('getAll')
            ->with($productFilter)
            ->willReturn($products->toArray());

        $result = $this->productService->getAll($productFilter);

        $this->assertCount(2, $result);
    }
}
