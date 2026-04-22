<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\StoreOrderRequest;
use App\Http\Resources\Transaction\OrderSummaryResource;
use App\Models\Transaction\Order;
use App\Models\User;
use App\Services\Transaction\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $service
    ) {}

    public function store(StoreOrderRequest $request): JsonResponse
    {
        try {
            $order = $this->service->store($request);
            return $this->successResponse(
                data: new OrderSummaryResource($order),
                message: 'Order berhasil dibuat',
                code: 201
            );
        } catch (\Throwable $e) {
            return $this->errorResponse(message: $e->getMessage(), code: $e->getCode() ?: 500);
        }
    }

    public function showUserOrder(User $user, Order $order): JsonResponse
    {
        try {
            $data = $this->service->getUserOrder($user, $order);
            return $this->successResponse(
                data: new OrderSummaryResource($data),
                message: 'Berhasil mengambil data order'
            );
        } catch (\Throwable $e) {
            return $this->errorResponse(message: $e->getMessage(), code: $e->getCode() ?: 500);
        }
    }
}
