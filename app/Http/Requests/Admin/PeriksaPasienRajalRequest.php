<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PeriksaPasienRajalRequest extends FormRequest
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
            'diagnosa' => 'required',
            'tindakan' => 'required',
            'keluhan' => 'required',
            'subjektif' => 'required',
            'objektif' => 'required',
            'assesment' => 'required',
            'status_lanjutan' => 'required',
        ];
    }
}
