<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\ProductResource;
use App\Services\Master\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        try {
            $data = $this->service->getAll($request);
            return $this->successResponse(
                data: ProductResource::collection($data),
                message: 'Berhasil mengambil data produk'
            );
        } catch (\Throwable $e) {
            return $this->errorResponse(message: $e->getMessage(), code: $e->getCode() ?: 500);
        }
    }
}
