<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAllotmentRequest extends FormRequest
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
            'teacher_id' => 'required',
            'class_course_id' => 'required',
            'course_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'teacher_id.required' => 'Please Select a Teacher',
            'course_id.required' => 'Please Select a Course',
            'class_course_id.required' => 'Please Select a Class',
        ];
    }
}
