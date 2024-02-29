<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait HttpApiTrait
{
    /**
     * @param Collection|Model|array $data
     * @param int $httpCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    public function respond($data, int $httpCode = Response::HTTP_OK, array $headers = []): JsonResponse
    {
        return response()->json($data, $httpCode, $headers);
    }
}
