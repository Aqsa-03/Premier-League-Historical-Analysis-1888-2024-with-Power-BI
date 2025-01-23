<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeetingLinkRequest extends FormRequest
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
            'link' => 'required',
            'description' => 'sometimes',
            'date_time' => 'sometimes',
        ];
    }

    public function messages()
    {
        return [
            'course_id.required' => 'Please Select a Course',
            'class_course_id.required' => 'Please Select a Class',
            'title.required' => 'Please Enter a Title',
            'date_time.required' => 'Please Select Date and Time',
        ];
    }
}
