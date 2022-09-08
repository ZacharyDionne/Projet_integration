<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlageDeTemps extends Model
{
    use HasFactory;

    public function up()
    {
        Schema::create('plagedetemps', function (Blueprint $table)
        {
            $table->id();
            $table->time('heureDebut');
            $table->time('heureFin');
            $table->tinyInteger('type');
            $table->timestamps();     
        });
    }

    public function typeTemps(): belongTo
    {
        return $this->belongTo('App\TypeTemps');
    }
}
