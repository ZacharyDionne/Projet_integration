<?php

namespace App\Http\Requests\Conducteur;

use Illuminate\Foundation\Http\FormRequest;

class ConducteurPasswordRequest extends FormRequest
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
            'motDePasse'     => 'required|min:6'
        ];
    }

    public function messages()
    {
        return[
            /* Messages motDePasse */
            "motDePasse.required" => "Veuillez entrez un mot de passe",
            "motDePasse.min" => "Le mot de passe doit avoir minimum 6 caractères",
        ];
    }
}
