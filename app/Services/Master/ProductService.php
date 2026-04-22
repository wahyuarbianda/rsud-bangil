<?php

namespace App\Services\Master;

use App\Models\Master\Product;
use Illuminate\Http\Request;

class ProductService
{
    public function __construct(
        protected Product $product
    ) {}

    public function getAll(Request $request)
    {
        $query = $this->product->newQuery()
            ->with('category')
            ->where('is_active', true);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        return $query->orderBy('id')->paginate($request->input('per_page', 10));
    }
}
