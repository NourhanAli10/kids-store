<?php

namespace App\Http\Requests\Auth\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|alpha|min:2|max:150',
            'last_name' => 'required|alpha|min:2|max:150',
            'email' => 'required|regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/|unique:users,email|max:190',
            'phone' => 'required|digits:11|regex:/^01[0125][0-9]{8}$/|unique:users,phone',
            'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'role' => 'required|in:user,admin',
        ];
    }
}
