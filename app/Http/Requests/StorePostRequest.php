<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:6'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Tên tiêu đề không được để trống.',
            'name.min' => 'Tên tiêu đề không dưới 6 kí tự.'
        ];
    }
}
