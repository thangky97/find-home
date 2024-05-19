<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'name' => 'required|min:3',
                'email' => 'required|email|max:50',
                'password' => 'required|min:6',
                'role' => 'required',
                'images' =>
                [
                    'image',
                    'max:2048',
                ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên bắt buộc nhập!',
                'name.min' => 'Tên tối thiểu 3 ký tự!',
                'email.required' => 'Email bắt buộc nhập!',
                'email.email' => 'Email không đúng định dạng!',
                'email.max' => 'Email tối đa 50 ký tự!',
                'password.required' => 'Mật khẩu bắt buộc nhập!',
                'password.min' => 'Mật khẩu tối thiểu 6 ký tự!',
                'role.required' => 'Vui lòng chọn vai trò!',
                'images.image' => 'Bắt buộc phải là ảnh!',
                'images.max' => 'Ảnh không được lớn hơn 2MB!',
        ];
    }
}
