<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreFormRequest extends FormRequest
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
            'name' =>  'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:7|max:10',
            'username' => 'required|string|max:255|unique:users',
            'role_id' => 'required',
            'phone' => 'required|min:11|max:11',
            'address' => 'required',
            'is_active' => 'required',
            'gender' => 'required',
        ];
    }
}
