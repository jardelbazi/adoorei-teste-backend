<?php

namespace App\Http\Controllers\Api;

use App\Adapters\Sale\SaleFilterRequestAdapter;
use App\Adapters\Sale\SaleRequestAdapter;
use App\Adapters\Sale\SaleUpdateRequestAdapter;
use App\Helpers\CollectionPaginator;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Services\Sale\SaleServiceInterface;
use App\Traits\HttpApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SaleController extends Controller
{
    use HttpApiTrait;

    public function __construct(
        private SaleServiceInterface $saleService,
    ) {
    }

    /**
     * @param SaleRequest $request
     * @return JsonResponse
     */
    public function store(SaleRequest $request)
    {
        $content = new SaleResource(
            $this->saleService->create(new SaleRequestAdapter($request))
        );

        return $this->respond($content, Response::HTTP_CREATED);
    }

    /**
     * @param SaleRequest $request
     * @return JsonResponse
     */
    public function addItem(SaleRequest $request): JsonResponse
    {
        $content = new SaleResource(
            $this->saleService->addItem(new SaleUpdateRequestAdapter($request))
        );

        return $this->respond($content);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function cancelSale(Request $request): JsonResponse
    {
        $content = new SaleResource(
            $this->saleService->cancelSale(new SaleFilterRequestAdapter($request))
        );

        return $this->respond($content);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $content = new SaleResource(
            $this->saleService->getOneBy(new SaleFilterRequestAdapter($request))
        );

        return $this->respond($content);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return SaleResource::collection(
            resource: CollectionPaginator::paginate($this->saleService->getAll(new SaleFilterRequestAdapter($request)))
        );
    }
}
