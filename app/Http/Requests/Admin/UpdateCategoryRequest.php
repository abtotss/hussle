<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize() { return auth()->check() && auth()->user()->role === 'admin'; }

    public function rules()
    {
        $categoryId = $this->route('category')?->id ?? null;

        return [
            'name' => ['required','string','max:120', Rule::unique('categories','name')->ignore($categoryId)],
            'slug' => ['nullable','string','max:120', Rule::unique('categories','slug')->ignore($categoryId)],
            'description' => 'nullable|string',
        ];
    }
}