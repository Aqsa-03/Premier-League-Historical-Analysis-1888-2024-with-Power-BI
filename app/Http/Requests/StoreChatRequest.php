<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChatRequest extends FormRequest
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
            'subject' => 'required',
            'body' => 'required',
            'file' => 'sometimes | file | mimes:ppt,pdf,doc,docx|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'teacher_id.required' => 'Please Select a Teacher',
            'subject.required' => 'Please Enter a Subject',
            'body.required' => 'Please Write Something in Body',
        ];
    }
}
