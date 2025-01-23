<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseContentRequest extends FormRequest
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
            'class_course_id' => 'required',
            'course_id' => 'required',
            'title' => 'required',
            'description' => 'sometimes',
            'file' => 'sometimes|required_without_all:link|file|mimes:ppt,pdf,doc,docx|max:10240',
            'link' => 'sometimes|required_without_all:file',
        ];
    }

    public function messages()
    {
        return [
            'course_id.required' => 'Please Select a Course',
            'class_course_id.required' => 'Please Select a Class',
            'title.required' => 'Please Enter a Title',
            'file.required_without_all' => 'Please upload a file or provide a link',
            'link.required_without_all' => 'Please provide a link or upload a file',
        ];
    }
}
