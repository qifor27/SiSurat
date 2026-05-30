<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSuratMasukRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomor_surat' => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'asal_surat' => 'required|string|max:255',
            'perihal' => 'required|string|max:500',
            'jenis_surat' => 'required|string',
            'tingkat_urgensi' => 'required|in:normal,segera,sangat_segera',
            'is_rahasia' => 'nullable|boolean',
            'file_surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];
    }

    /**
     * pesan error dalam bahasa indosia
     * Agar user paham apa yang salah saat validasi gagal
     */
    public function messages(): array
    {
        return [
            'nomor_surat.required' => 'Nomor surat wajib diisi',
            'nomor_surat.max' => 'Nomor surat maksimal 100 karakter.',
            'tanggal_surat.required' => 'Tanggal surat wajib diisi.',
            'tanggal_surat.date' => 'Format tanggal surat wajib diisi.',
            'tanggal_diterima.required' => 'Tanggal diterima wajib diisi.',
            'tanggal_diterima.date' => 'Format tanggal diterima tidak valid.',
            'asal_surat.required' => 'Asal surat wajib diisi.',
            'asal_surat.max' => 'Asal surat maksimal 255 karakter.',
            'perihal.required' => 'Perihal wajib diisi.',
            'perihal.max' => 'Perihal maksimal 500 karakter.',
            'jenis_surat.required' => 'Jenis surat wajib dipilih.',
            'tingkat_urgensi.required' => 'Tingkat urgensi wajib dipilih.',
            'tingkat_urgensi.in' => 'Tingkat urgensi tidak valid.',
            'file_surat.file' => 'Lampiran harus berupa file.',
            'file_surat.mimes' => 'Format file harus PDF, JPG, JPEG, atau PNG.',
            'file_surat.max' => 'Ukuran file maksimal 5MB.',
            'file_surat.uploaded' => 'File gagal diupload. Pastikan ukuran tidak melebihi 5MB.',
        ];
    }
}
