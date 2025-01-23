<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'batch_no' => 'required',
            'department_id' => 'required',
            'roll_no' => 'required',
            'semester_id' => 'required',
            'section_id' => 'required',
            'email' => 'required | unique:users,email',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please Enter The Student\'s Name',
            'email.required' => 'Please Enter The Student\'s Email',
            'password.required' => 'Please Enter a Password',
            'department_id.required' => 'Please Select A Department',
            'section_id.required' => 'Please Select A Section',
            'batch_no.required' => 'Please Select Batch Number',
            'roll_no.required' => 'Please Select Roll #',
            'semester_id.required' => 'Please Select A Semester',
        ];
    }
}
