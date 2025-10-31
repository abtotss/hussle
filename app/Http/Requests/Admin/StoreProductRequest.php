<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize() { return auth()->check() && auth()->user()->role === 'admin'; }

    public function rules()
    {
        return [
            'name' => 'required|string|max:150',
            'slug' => 'nullable|string|max:150|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:50|unique:products,sku',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|max:2048', // 2MB
        ];
    }
}
