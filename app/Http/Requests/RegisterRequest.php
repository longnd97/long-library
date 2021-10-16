<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstName' => 'required|min:2|max:32',
            'lastName' => 'required|min:2|max:32',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:32|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'firstName.required' => 'Tên không được để trống!',
            'firstName.min' => 'Tên có ít nhất 2 ký tự!',
            'firstName.max' => 'Tên có nhiều nhất 32 ký tự!',
            'lastName.required' => 'Họ không được để trống!',
            'lastName.min' => 'Họ có ít nhất 2 ký tự!',
            'lastName.max' => 'Họ có nhiều nhất 32 ký tự!',
            'email.required' => 'Vui lòng điền email',
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã tồn tại!',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp!',
            'password.required' => 'Mật khẩu không được để trống!',
        ];
    }
}
