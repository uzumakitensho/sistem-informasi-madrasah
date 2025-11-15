<?php

namespace Modules\TahunAjaran\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTahunAjaranRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'tahun_mulai' => [
                'required',
                'integer',
                'min:2000',
                'max:5000',
                Rule::unique('school_years', 'year_start')->ignore($this->route('school_year')->id),
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
