<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiche extends Model
{
    use HasFactory;

    protected $fillable = ['conducteur_id', 'cycle', 'observation', 'date'];


    public function conducteur() : BelongsTo
    {
        return $this->belongsTo("App/Models/Conducteur");
    }


}
