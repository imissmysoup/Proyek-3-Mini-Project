<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    use Illuminate\Validation\Rule;

    public function rules(): array
    {
        return [
            'sekolah_id' => 'required|exists:sekolahs,id',
            'distribusi_id' => [
                'required',
                Rule::exists('distribusis', 'id')->where('sekolah_id', $this->sekolah_id),
            ],
            'keluhan' => 'required|string',
            'path_bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
}