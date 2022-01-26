<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranPasienBaruRequest extends FormRequest
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
                    'nama' => 'required',
                    'no_bpjs' => 'required|unique:pasien,no_bpjs',
                    'no_sep' => 'required',
                    'nik' => 'required|unique:pasien,nik|numeric',
                    'jenis_kelamin' => 'required',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                    'agama' => 'required',
                    'no_hp' => 'required',
                    'alamat' => 'required',
                    'kategori_pasien' => 'required',
                    'poli_id' => 'required',
                    'layanan_id' => 'required',
                    'faskes_id' => 'required',
                    'dokter_id' => 'required',
                    'tujuan' => 'required',
                ];
        } else {
            return [
                'nama' => 'required',
                'nik' => 'required|unique:pasien,nik|numeric',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'agama' => 'required',
                'no_hp' => 'required',
                'alamat' => 'required',
                'kategori_pasien' => 'required',
                'poli_id' => 'required',
                'layanan_id' => 'required',
                'dokter_id' => 'required',
                'tujuan' => 'required',
            ];
        }
    }
}
