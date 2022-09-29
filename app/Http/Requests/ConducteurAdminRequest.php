<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConducteurAdminRequest extends FormRequest
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
            'prenom'         => 'required|min:2|max:20',
            'nom'            => 'required|min:2|max:20',
            'matricule'      => 'required|min:2|max:6',
            'adresseCourriel'=> 'required|min:5|max:80',
            'motDePasse'     => 'nullable|min:6'
        ];
    }


    public function messages()
    {
        return [
             /* Message actif */
             "actif.required" => "Veuillez notez si l'employé est toujours actif ou non",

             /* Messages prénom */
             "prenom.required" => "Veuillez entrez un prénom",
             "prenom.min" => "Le prénom doit avoir minimum 2 caractères",
             "prenom.max" => "Le prénom doit avoir maximum 80 caractères",
 
             /* Messages nom */
             "nom.required" => "Veuillez entrez un nom",
             "nom.min" => "Le nom doit avoir minimum 2 caractères",
             "nom.max" => "Le nom doit avoir maximum 80 caractères",
 
             /* Messages matricule */
             "matricule.required" => "Veuillez entrez un matricule",
             "matricule.min" => "Le matricule doit avoir minimum 2 caractères",
             "matricule.max" => "Le matricule doit avoir maximum 6 caractères",
 
             /* Messages adresseCourriel */
             "adresseCourriel.required" => "Veuillez entrez un courriel",
             "adresseCourriel.min" => "Le courriel doit avoir minimum 5 caractères",
             "adresseCourriel.max" => "Le nom doit avoir maximum 80 caractères",
 
             /* Messages motDePasse */
             "motDePasse.min" => "Le mot de passe doit avoir minimum 6 caractères"
        ];
    }


}
