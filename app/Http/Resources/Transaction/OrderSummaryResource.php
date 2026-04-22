<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'product'     => $this->whenLoaded('product', fn() => [
                'id'   => $this->product->id,
                'name' => $this->product->name,
            ]),
            'user'        => $this->whenLoaded('user', fn() => $this->user?->name),
            'qty'         => $this->qty,
            'total_price' => 'Rp ' . number_format($this->total_price, 0, ',', '.'),
            'status'      => $this->status,
            'created_at'  => $this->created_at,
        ];
    }
}
