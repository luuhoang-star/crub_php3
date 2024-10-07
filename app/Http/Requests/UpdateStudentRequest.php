<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->segment(2);
        return [
            'code' => ['required', 'max:10', Rule::unique('students')->ignore($id)],
            'name' => ['required', 'max:191'],
            'email' => [
                'required',
                'email',
                'max:191',
                Rule::unique('students')->ignore($id)
            ],
            'phone' => ['required', 'max:20'],
            'image' => ['required', Rule::requiredIf(empty(request('image_url')))],
        ];
    }
}
