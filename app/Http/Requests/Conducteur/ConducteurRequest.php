<?php

namespace App\Http\Requests\Conducteur;

use Illuminate\Foundation\Http\FormRequest;

class ConducteurRequest extends FormRequest
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
            'prenom'         => 'required|min:2|max:20',
            'nom'            => 'required|min:2|max:20',
            'adresseCourriel'=> 'required|min:5|max:80',
        ];
    }


    public function messages()
    {
        return [
             /* Messages prénom */
            "prenom.required" => "Veuillez entrez un prénom",
            "prenom.min" => "Le prénom doit avoir minimum 2 caractères",
            "prenom.max" => "Le prénom doit avoir maximum 80 caractéres",

            /* Messages nom */
            "nom.required" => "Veuillez entrez un nom",
            "nom.min" => "Le nom doit avoir minimum 2 caractères",
            "nom.max" => "Le nom doit avoir maximum 80 caractéres",

            /* Messages adresseCourriel */
            "adresseCourriel.required" => "Veuillez entrez un courriel",
            "adresseCourriel.min" => "Le courriel doit avoir minimum 5 caractères",
            "adresseCourriel.max" => "Le nom doit avoir maximum 80 caractéres",
        ];
    }


}
