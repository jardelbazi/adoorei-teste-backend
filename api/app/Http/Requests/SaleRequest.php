<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        $rule = [
            'products' => 'required|array',
            'products.*.product_id' => ['required', 'integer', 'exists:products,id,deleted_at,NULL'],
            'products.*.amount' => 'required|integer',
            'products.*.price' => 'prohibited',
        ];

        if ($this->method() == 'PATCH') {
            $rule['products.*.product_id'] = Rule::unique('sale_products')->where(function ($query) {
                return $query->where('sale_id', $this->id);
            });
        }

        return $rule;
    }
}
