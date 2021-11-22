<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitorCreateRequest extends FormRequest
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
            'first_name'=>['string', 'max:15', 'required'],
            'prefix'=>['string', 'max:10', 'required'],
            'last_name'=>['string', 'max:15', 'required'],
            'email' => 'email:rfc,dns',
            'license_plate' => ['max:8'],
        ];
    }
}
