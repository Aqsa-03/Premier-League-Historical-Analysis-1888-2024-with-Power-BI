<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'detail' => 'required',
            'start_date_time' => 'required',
            'end_date_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter a Title',
            'detail.required' => 'Please Enter Detail',
            'start_date_time.required' => 'Please Select Start Date & Time',
            'end_date_time.required' => 'Please Select End Date & Time',
        ];
    }
}
