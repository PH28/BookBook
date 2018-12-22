<?php

namespace Book\Http\Requests;

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
            'email'      => 'required|string|email|max:255|unique:users',
            'last_name'  => 'string|min:2|max:10',
            'first_name' => 'string|min:2|max:10',
            'birthday'   => 'required|before:tomorrow',
            'password'   => 'required|string|min:6|confirmed',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'     => 'Vui lòng nhập địa chỉ email',
            'email.string'       => 'Địa chỉ email phải là một chuỗi',
            'email.email'        => 'Địa chỉ email không hợp lệ',
            'email.unique'       => 'Địa chỉ này email đã tồn tại',
            'last_name.string'   => '',
            'last_name.min'      => 'Họ phải có ít nhất 2 ký tự',
            'last_name.max'      => 'Họ không được quá 10 ký tự',
            'first_name.min'     => 'Tên phải có ít nhất 2 ký tự',
            'first_name.max'     => 'Tên không được quá 10 ký tự',
            'first_name.string'  => '',
            'birthday.required'  => 'Vui lòng chọn ngày sinh',
            'birthday.before'    => 'Ngày sinh không hợp lệ',
            'password.required'  => 'Vui lòng nhập mật khẩu',
            'password.min'       => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
        ];
    }
}