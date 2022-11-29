<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTemps extends Model
{
    use HasFactory;

    protected $table = "typetemps";

    public function plageDeTemps() : HasMany
    {
        return $this->hasMany('App\PlageDeTemps');
    }
}