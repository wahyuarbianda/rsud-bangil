<?php

namespace App\Http\Requests\Transaction;

use App\Traits\MessageValidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    use MessageValidation;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'qty'        => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Produk wajib dipilih.',
            'product_id.exists'   => 'Produk tidak ditemukan.',
            'qty.required'        => 'Jumlah produk wajib diisi.',
            'qty.integer'         => 'Jumlah produk harus berupa angka.',
            'qty.min'             => 'Jumlah produk minimal 1.',
        ];
    }
}
