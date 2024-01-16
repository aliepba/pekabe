<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanAkunRequest extends FormRequest
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
            'jenis_penyelenggara' => 'required',
            'nama_instansi' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pkb_users'],
            'alamat' => 'required',
            'telepon' => 'required',
            'provinsi' => 'required',
            'kab_kota' => 'required',
            'file1' => 'max:7000|mimes:pdf',
            'file2' => 'max:2000|mimes:pdf',
            'file3' => 'max:2000|mimes:pdf',
            'nama_penanggung_jawab' => 'required',
            'nik' => 'required',
            'jabatan' => 'required',
            'email' =>  ['required', 'string', 'email'],
            'npwp' => 'required',
            'upload_persyaratan' => 'max:2000|mimes:pdf'
        ];
    }
}
