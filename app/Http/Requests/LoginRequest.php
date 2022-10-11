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
            "email" => "required|min:5|max:80",
            "password" => "required|min:6"
        ];
    }


    public function messages()
    {
        return [
            "email.required" => "L'adresse courriel est obligatoire.",
            "email.min" => "Adresse courriel invalide.",
            "email.max" => "Adresse courriel invalide.",
            "password.required" => "Le mot de passe est obligatoire.",
            "password.min" => "Mot de passe invalide"
        ];
    }


}
