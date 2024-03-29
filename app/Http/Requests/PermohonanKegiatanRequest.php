<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanKegiatanRequest extends FormRequest
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
            'subklas' => 'required',
            'jenis_kegiatan' => 'required',
            'unsur_kegiatan' => 'required',
            'tingkat_kegiatan' => 'required',
            'metode_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
            'tempat_kegiatan' => 'required',
            'start_kegiatan' => 'required',
            'end_kegiatan' => 'required',
            'tor_kak' => 'max:2000|mimes:pdf',
            'sk_panitia' => 'max:2000|mimes:pdf',
            'cv' => 'max:2000|mimes:pdf',
            'persyaratan_lain' => 'max:2000|mimes:pdf',
            'persyaratan_lain_lain' => 'max:2000|mimes:pdf',
        ];
    }
}
