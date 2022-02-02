<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user = $this->user;

        $rules = [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'permissions' => 'required',
            'role' => 'required',
        ];

        if ($this->method() == 'PUT') {
            $rules['username'] = 'unique:users,username,' . $user;
            $rules['email'] = 'unique:users,email,' . $user;
        }

        return $rules;
    }
}
