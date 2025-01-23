<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
            'status' => 'required',
            // 'password' => 'required | confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter The Teacher\'s Name',
            'email.required' => 'Please Enter The Teacher\'s Email',
            'status.required' => 'Please Select A Status',
            'department_id.required' => 'Please Select A Department',
            // 'password.required' => 'Please Enter a Password',
        ];
    }
}
