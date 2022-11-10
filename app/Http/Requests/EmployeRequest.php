<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'actif'          => 'required',
        ];
    }

    public function messages()
    {
        return[
            /* Message actif */
            "actif:required" => "Veuillez notez si l'employé est toujours actif ou non",
        ];
    }
}
