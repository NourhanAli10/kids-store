<?php

namespace App\Http\Requests\store;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address_type' => 'required|in:home,work,other',
            'address' => 'required|string',
            'town' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'order_note' => 'nullable|string|max:1000',
            'payment_method' => 'required'
        ];

        if ($this->filled('ship_to_another_address')) {
            $rules = array_merge($rules, [
                'shipping_first_name' => 'required|string|max:255',
                'shipping_last_name' => 'required|string|max:255',
                'shipping_address_type' => 'required|in:home,work,other',
                'shipping_address' => 'required|string',
                'shipping_town' => 'required|string|max:255',
                'shipping_city' => 'required|string|max:255',
                'save_shipping_address' => 'nullable|boolean',
            ]);
        }

        return $rules;
    }
}
