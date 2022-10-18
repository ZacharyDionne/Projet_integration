<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "adresseCourriel" => "required|min:5|max:80",
            "motDePasse" => "required|min:6"
        ];
    }


    public function messages()
    {
        return [
            "adresseCourriel.required" => "L'adresse courriel est obligatoire.",
            "adresseCourriel.min" => "Adresse courriel invalide.",
            "adresseCourriel.max" => "Adresse courriel invalide.",
            "motDePasse.required" => "Le mot de passe est obligatoire.",
            "motDePasse.min" => "Mot de passe invalide"
        ];
    }


}
