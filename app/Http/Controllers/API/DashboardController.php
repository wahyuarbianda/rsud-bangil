<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\OrderSummaryResource;
use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $service
    ) {}

    public function summary(): JsonResponse
    {
        try {
            $data = $this->service->getSummary();

            $fromCache      = $data['from_cache'];
            $recentOrders   = $data['recent_orders'];
            unset($data['from_cache'], $data['recent_orders']);

            $data['recent_orders'] = OrderSummaryResource::collection($recentOrders)->resolve();
            $data['from_cache']    = $fromCache;

            return $this->successResponse(data: $data, message: 'Berhasil mengambil data dashboard');
        } catch (\Throwable $e) {
            return $this->errorResponse(message: $e->getMessage(), code: $e->getCode() ?: 500);
        }
    }

    public function flushCache(): JsonResponse
    {
        try {
            $this->service->flushCache();
            return $this->successResponse(message: 'Cache dashboard berhasil dihapus');
        } catch (\Throwable $e) {
            return $this->errorResponse(message: $e->getMessage(), code: $e->getCode() ?: 500);
        }
    }
}
