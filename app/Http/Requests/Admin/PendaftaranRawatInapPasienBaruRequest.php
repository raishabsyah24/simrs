<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranRawatInapPasienBaruRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public $pasienBpjs  = 1;
    public $pasienUmum  = 2;
    public $pasienAsuransi  = 3;

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
        $penanggung_jawab_sama_dengan_pasien = $this->penanggung_jawab_sama_dengan_pasien;
        $rules = [
            // Kategori pasien
            'kategori_pasien' => 'required',
            // Pasien
            'nama' => 'required',
            'nik' => 'required|unique:pasien,nik|numeric',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'agama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'penanggung_jawab_sama_dengan_pasien' => 'required',
            'hubungan_dengan_pasien' => 'required',
            'nurse_station_id' => 'required',
            'ruangan_id' => 'required',
        ];

        if ($penanggung_jawab_sama_dengan_pasien == 'tidak') {
            // Penanggung Jawab
            $rules['nama_penanggung_jawab'] = 'required';
            $rules['nik_penanggung_jawab'] = 'required';
            $rules['no_hp_penanggung_jawab'] = 'required';
            $rules['jenis_kelamin_penanggung_jawab'] = 'required';
            $rules['alamat_penanggung_jawab'] = 'required';
        }

        if ($kategori_pasien == $this->pasienBpjs) {
            $rules['no_bpjs'] = 'required';
            $rules['no_sep'] = 'required';
        } else if ($kategori_pasien == $this->pasienUmum) {
            $rules['deposit_awal'] = 'required';
        } else if ($kategori_pasien == $this->pasienAsuransi) {
            $rules['asuransi_id'] = 'required';
            $rules['no_asuransi'] = 'required';
        }

        return $rules;
    }
}
