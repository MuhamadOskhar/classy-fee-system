<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class KelasUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id_kelas' => ['required'],
            'nama_kelas' => ['required'],
            'id_jurusan' => ['required'],
            'status_data' => ['required'],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function messages(): array
    {
        return [
            'id_kelas.required' => "Data id kelas kosong !!",
            'nama_kelas.unique' => "Nama Kelas sudah digunakan !! Harap menggunakan nama kelas lain",
            'nama_kelas.required' => "Nama Kelas wajib diisi !!",
            'id_jurusan.required' => "Jurusan wajib diisi !!",
            'status_data.in' => 'Status data hanya dapat diisi dengan "Aktif" atau "Tidak Aktif"',
        ];
    }

    /**
     * Aksi saat data tervalidasi salah
     * @param Validator
     */
    public function failedValidation (Validator $validator)
    {
        throw new HttpResponseException(response([
            "errors" => $validator->getMessageBag()
        ], 400));
    }
}
