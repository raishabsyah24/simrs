<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DokterRequest extends FormRequest
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
            'nama' => 'required',
            'nik' => 'required|unique:dokter,nik',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'no_hp' => 'required',
            'email' => 'required|unique:users,email',
            'poli_id' => 'required',
            'alamat' => 'required',
            'foto' => 'file|image|mimes:png,jpg,jpeg|max:2048',
        ];

        // if ($this->method() == 'PUT') {
        //     $rules['username'] = 'unique:users,username,' . $user;
        //     $rules['email'] = 'unique:users,email,' . $user;
        // }

        return $rules;
    }
}
