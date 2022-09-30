<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FicheRequest extends FormRequest
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
            'conducteur_id'  => 'required',
            'observation'    => 'required|min:2|max:150',
            'cycle'          => 'required',
            'date'           => 'required',
        ];
    }

    public function message()
    {
        return[
            /* Message conducteur_id */
            "conducteur_id" => "Veuillez notez le conducteur ou vous identifier si ce n'est pas déjà fait",

            /* Messages observation */
            "observation.required" => "Veuillez entrez une observation",
            "observation.min" => "L'observation doit avoir minimum 2 caractéres",
            "observation.max" => "L'observation doit avoir maximum 150 caractéres",

            /* Messages cycle */
            "cycle.required" => "Veuillez vous assurez qu'un cycle est bien sélectionné",

            /* Messages date */
            "date.required" => "Veuillez entrez une date pour la fiche",
        ];
    }
}
