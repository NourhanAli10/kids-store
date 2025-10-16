<?php

namespace App\Http\Requests\Auth;

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
        ];
    }


     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages() :array
    {
        return [
            //name
            'first_name.required' => "First name is required",
            'first_name.alpha' => "First name should be letters only",
            'first_name.max' => "First name should be less than 150 characters",
            'first_name.min' => "First name must be at least 2 characters",


            'last_name.required' => "last name is required",
            'last_name.alpha' => "last name should be letters only",
            'last_name.max' => "last name should be less than 150 characters",
            'last_name.min' => "last name must be at least 2 characters",
            //email
            'email.required' => "Email is required",
            'email.regex' => "Invalid email",
            'email.unique' => "This email has already been taken",
            'email.max' => "The email field cannot be more than 190 characters long.",
            //Phone number
            'phone.required' => "Phone number is required",
            'phone.digits' => "Phone number must be 11 digits",
            'phone.regex' => "Invalid phone number",
            'phone.unique' => "This phone number has already been taken",
            //password
            'password.required' => "Password is required",
            'password.confirmed' => "Passwords do not match",
            'password.regex' => "Password must contain eight characters at least one letter and one number",

        ];
    }
}
