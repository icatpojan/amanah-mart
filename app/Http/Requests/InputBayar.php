<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputBayar extends FormRequest
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
        alert()->error('WOW', 'masukan angka');
        return [
            'dibayar' => 'integer',
        ];
    }
}
