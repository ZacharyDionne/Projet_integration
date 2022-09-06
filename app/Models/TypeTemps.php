<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTemps extends Model
{
    use HasFactory;

    public function up()
    {
        Schema::create('typeTemps', function (Blueprint $table)
        {
            $table->id();
            $table->string('typeTemps', 100);
            $table->timestamps();     
        });
    }

    public function plageDeTemps() : HasMany
    {
        return $this->hasMany('App\PlageDeTemps');
    }
}