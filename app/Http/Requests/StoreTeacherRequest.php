<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'department_id' => 'required',
            'email' => 'required | unique:users,email',
            'password' => 'required | confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter The Teacher\'s Name',
            'email.required' => 'Please Enter The Teacher\'s Email',
            'password.required' => 'Please Enter a Password',
            'department_id.required' => 'Please Select A Department',
        ];
    }
}
