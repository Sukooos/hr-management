<?php

namespace App\Http\Requests\Recruitment;

use Illuminate\Foundation\Http\FormRequest;

class StepOneRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'full_name' => 'required|string|max:100',
            'email'     => 'required|email|max:100',
            'phone'     => 'required|string|max:20',
            'ktp'       => 'nullable|string|max:32',
            'cv_file'   => 'required|file|mimes:pdf,doc,docx|max:2048',
        ];
    }
}
