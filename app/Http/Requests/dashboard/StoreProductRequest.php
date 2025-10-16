<?php

namespace App\Http\Requests\dashboard;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'price' => 'required',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'status' => ['required', Rule::in(['available', 'unavailable'])],
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'integer|exists:sizes,id',
            'colors' => 'required|array|min:1',
            'colors.*' => 'integer|exists:colors,id',
            'stock' => 'required|array|min:1',
            'stock.*' => 'required|integer|min:1',
        ];
    }
}
