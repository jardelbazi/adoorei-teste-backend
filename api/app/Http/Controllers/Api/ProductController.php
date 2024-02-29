<?php

namespace App\Http\Controllers\Api;

use App\Adapters\Product\ProductFilterRequestAdapter;
use App\Adapters\Product\ProductRequestAdapter;
use App\Adapters\Product\ProductUpdateRequestAdapter;
use App\Helpers\CollectionPaginator;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\Product\ProductServiceInterface;
use App\Traits\HttpApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    use HttpApiTrait;

    public function __construct(
        private ProductServiceInterface $productService,
    ) {
    }

    /**
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $content = new ProductResource(
            $this->productService->create(new ProductRequestAdapter($request))
        );

        return $this->respond($content, Response::HTTP_CREATED);
    }

    /**
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function update(ProductRequest $request): JsonResponse
    {
        $content = new ProductResource(
            $this->productService->update(new ProductUpdateRequestAdapter($request))
        );

        return $this->respond($content);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $this->productService->delete(new ProductFilterRequestAdapter($request));
        return $this->respond([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $content = new ProductResource(
            $this->productService->getOneBy(new ProductFilterRequestAdapter($request))
        );

        return $this->respond($content);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return ProductResource::collection(
            resource: CollectionPaginator::paginate($this->productService->getAll(new ProductFilterRequestAdapter($request)))
        );
    }
}
