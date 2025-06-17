<?php

namespace App\Http\Requests\Recruitment;

use Illuminate\Foundation\Http\FormRequest;

class StepTwoRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        // Misal: 3 pertanyaan, wajib isi semua
        return [
            'answers' => 'required|array|min:1',
            'answers.*' => 'required|string|max:5000',
        ];
    }
}
