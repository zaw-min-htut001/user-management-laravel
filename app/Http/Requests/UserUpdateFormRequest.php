<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateFormRequest extends FormRequest
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
        $userId = $this->route('user') ? $this->route('user') : null;

        return [
            'name' =>  'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'password' => 'required|min:7|max:10',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)],
            'role_id' => 'required',
            'phone' => 'required|min:11|max:11',
            'address' => 'required',
            'is_active' => 'required',
            'gender' => 'required',
        ];
    }
}
