<?php

namespace App\Http\Requests\Recruitment;

use Illuminate\Foundation\Http\FormRequest;

class StepThreeRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'documents' => 'required|array|min:1',
            'documents.*' => 'file|max:3072', // per file max 3MB
            'expected_salary' => 'required|numeric|min:0',
        ];
    }
}
