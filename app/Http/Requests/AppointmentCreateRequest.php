<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentCreateRequest extends FormRequest
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
            'manager_id' => ['exists:managers,id','required'],
            'visitor_id' => ['exists:visitors,id','required'],
            'starts_at' => ['date', 'required'],
            'ends_at' => ['required'],
        ];
    }
}
