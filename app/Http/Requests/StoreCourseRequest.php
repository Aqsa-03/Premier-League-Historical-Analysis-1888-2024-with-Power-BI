<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'code' => 'required',
            'credit_hours' => 'required',
            'description' => 'sometimes',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter The Course\'s Name',
            'code.required' => 'Please Enter The Course\'s Code',
            'credit_hours.required' => 'Please Enter The Course\'s Credit Hours',
        ];
    }
}
