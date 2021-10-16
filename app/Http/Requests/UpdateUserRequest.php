<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:32',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường này không được để trống!',
            'name.min' => 'Trường này có ít nhất 2 ký tự!',
            'name.max' => 'Trường này nhiều nhất 32 ký tự!',
            'email.required' => 'Trường này không được để trống!',
            'email.email' => 'Email không hợp lệ!',
        ];
    }
}
