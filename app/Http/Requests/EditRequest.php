<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'jenis_kelamin' => 'required',
            'nisn' => 'required|size:10',
            'nik' => 'required|size:16',
            'no_kk' => 'required|size:16',
            'tempat' => 'required',
            'tanggal_lahir' => 'required',
            'mobil' => 'required',
            'tinggal' => 'required',
            'anak_ke' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'desa_siswa' => 'required',
            'kec_siswa' => 'required',
            'kab_siswa' => 'required',
            'prov_siswa' => 'required',
            'agama' => 'required',
            'nama_ayah' => 'required',
            'nik_ayah' => 'required|size:16',
            'tahun_ayah' => 'required',
            'pend_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'penghasilan_ayah' => 'required',
            'nama_ibu' => 'required',
            'nik_ibu' => 'required|size:16',
            'tahun_ibu' => 'required',
            'pend_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ibu' => 'required',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'jarak' => 'required',
            'waktu' => 'required',
            'jumlah_saudara' => 'required',
            'asal_sekolah' => 'required',
            'npsn_asal' => 'required|size:8',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
        ];
    }
}
