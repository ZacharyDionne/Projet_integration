<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlageDeTemps extends Model
{
    use HasFactory;



    public function typeTemps(): belongTo
    {
        return $this->belongTo('App\TypeTemps');
    }
}
