<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentAssignmentRequest extends FormRequest
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
            'comment' => 'sometimes',
            'assignment_id' => 'required',
            'file' => 'file | required | mimes:pdf,doc,docx|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Please Upload a File',
        ];
    }
}
