<?php

namespace App\Http\Requests\Auth\dashboard;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'sometimes|required|alpha|min:2|max:150',
            'last_name' => 'sometimes|required|alpha|min:2|max:150',
            'phone' => 'sometimes|required|digits:11|regex:/^01[0125][0-9]{8}$/|unique:users,phone,' . $this->user,
            'email' => 'sometimes|required|regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/|
                max:190|unique:users,email,'. $this->user,
            'role' => 'sometimes|required|in:user,admin',

        ];
    }
}
