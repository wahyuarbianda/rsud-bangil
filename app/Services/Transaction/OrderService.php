<?php

namespace App\Services\Transaction;

use App\Models\Master\Product;
use App\Models\Transaction\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(
        protected Order $order,
        protected Product $product
    ) {}

    public function store($request): Order
    {
        $product = $this->product->findOrFail($request->product_id);

        if ($product->stock < $request->qty) {
            throw new \Exception('Stok produk tidak mencukupi', 422);
        }

        return DB::transaction(function () use ($request, $product) {
            $order = $this->order->create([
                'product_id'  => $product->id,
                'qty'         => $request->qty,
                'total_price' => $product->price * $request->qty,
                'status'      => 'pending',
            ]);

            $product->decrement('stock', $request->qty);

            return $order->load('product.category');
        });
    }

    public function getUserOrder(User $user, Order $order): Order
    {
        if ($order->user_id !== $user->id) {
            throw new \Exception('Order tidak ditemukan', 404);
        }

        return $order->load('product.category', 'user');
    }
}
