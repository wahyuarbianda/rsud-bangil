<?php

namespace App\Services;

use App\Models\Master\Product;
use App\Models\Transaction\Order;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    public function getSummary(): array
    {
        $cacheKey  = 'dashboard_summary';
        $fromCache = Cache::has($cacheKey);

        $data = Cache::remember($cacheKey, 300, fn() => [
            'statistics'    => $this->buildStatistics(),
            'top_products'  => $this->buildTopProducts(),
            'recent_orders' => $this->buildRecentOrders(),
        ]);

        $data['from_cache'] = $fromCache;

        return $data;
    }

    public function flushCache(): void
    {
        Cache::forget('dashboard_summary');
    }

    private function buildStatistics(): array
    {
        return [
            'total_revenue'          => (float) Order::where('status', 'completed')->sum('total_price'),
            'total_orders_today'     => Order::whereDate('created_at', today())->count(),
            'total_products_active'  => Product::where('is_active', true)->count(),
            'low_stock_count'        => Product::where('stock', '<', 5)->count(),
        ];
    }

    private function buildTopProducts(): array
    {
        return Order::selectRaw('product_id, SUM(qty) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->with('product.category')
            ->get()
            ->map(fn($row) => [
                'product_id'   => $row->product_id,
                'product_name' => $row->product?->name,
                'category'     => $row->product?->category?->name,
                'total_sold'   => (int) $row->total_sold,
            ])
            ->toArray();
    }

    private function buildRecentOrders()
    {
        return Order::with('user', 'product')->latest()->limit(10)->get();
    }
}
