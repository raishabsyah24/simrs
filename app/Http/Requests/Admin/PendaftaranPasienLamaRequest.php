<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranPasienLamaRequest extends FormRequest
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
        $kategori_pasien = $this->kategori_pasien;
        if ($kategori_pasien == 1) {
            return
                [
                    'pasien' => 'required',
                    'no_sep' => 'required',
                    'kategori_pasien' => 'required',
                    'poli_id' => 'required',
                    'layanan_id' => 'required',
                    'faskes_id' => 'required',
                    'dokter_id' => 'required',
                    'tujuan' => 'required',
                    'tanggal' => 'required|date_format:Y-m-d',
                ];
        } else {
            return [
                'pasien' => 'required',
                'kategori_pasien' => 'required',
                'poli_id' => 'required',
                'layanan_id' => 'required',
                'dokter_id' => 'required',
                'tujuan' => 'required',
                'tanggal' => 'required|date_format:Y-m-d',

            ];
        }
    }
}
