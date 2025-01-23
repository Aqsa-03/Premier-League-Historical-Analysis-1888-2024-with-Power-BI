<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContentRequest extends FormRequest
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
            'grade_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'chapter_id' => 'required',
            'subject_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'grade_id.required' => 'Please Select a Grade',
            'subject_id.required' => 'Please Select a Subject',
            'chapter_id.required' => 'Please Select a Chapter',
            'title.required' => 'Please Enter a Title',
            'description.required' => 'Please Enter a Description',
        ];
    }
}
