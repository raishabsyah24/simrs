<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranRawatJalanPasienBaruRequest extends FormRequest
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
        $penanggung_jawab_sama_dengan_pasien = $this->penanggung_jawab_sama_dengan_pasien;
        $rules = [
            // Pasien
            'penanggung_jawab_sama_dengan_pasien' => 'required',
            'nama' => 'required',
            'nik' => 'required|unique:pasien,nik|numeric',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'tanggal' => 'required|date_format:Y-m-d',
            'agama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'kategori_pasien' => 'required',
            'poli_id' => 'required',
            'layanan_id' => 'required',
            'dokter_id' => 'required',
            'pasien_sudah_membaca_dan_setuju_dengan_peraturan' => 'required',
            'hubungan_dengan_pasien' => 'required',
        ];
        if ($penanggung_jawab_sama_dengan_pasien == 'tidak') {
            // Penanggung Jawab
            $rules['nama_penanggung_jawab'] = 'required';
            $rules['nik_penanggung_jawab'] = 'required';
            $rules['no_hp_penanggung_jawab'] = 'required';
            $rules['jenis_kelamin_penanggung_jawab'] = 'required';
            $rules['alamat_penanggung_jawab'] = 'required';
        }
        if ($kategori_pasien == 1) {
            $rules['no_bpjs'] = 'required';
            $rules['no_sep'] = 'required';
            $rules['faskes_id'] = 'required';
        }

        return $rules;
    }
}
