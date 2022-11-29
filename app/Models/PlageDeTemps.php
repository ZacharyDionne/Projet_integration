<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlageDeTemps extends Model
{
    use HasFactory;

    protected $fillable = ["heureDebut", "heureFin"];
    protected $table = "plagedetemps";

    public function typeTemps(): belongTo
    {
        return $this->belongsTo('App\TypeTemps');
    }
}
