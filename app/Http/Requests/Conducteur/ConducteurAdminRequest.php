<?php

namespace App\Http\Requests\Conducteur;

use App\Http\Requests\Conducteur\ConducteurRequest;

class ConducteurAdminRequest extends ConducteurRequest
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
        return parent::rules() + [
            'actif' => 'required',
            'matricule' => 'required|min:2|max:6'
        ];
    }

    public function messages()
    {
        return parent::messages() + [
            /* Message actif */
            "actif.required" => "Veuillez notez si l'employé est toujours actif ou non",

            /* Messages matricule */
            "matricule.required" => "Veuillez entrez un matricule",
            "matricule.min" => "Le matricule doit avoir minimum 2 caractéres",
            "matricule.max" => "Le matricule doit avoir maximum 6 caractéres",
        ];
    }
}
