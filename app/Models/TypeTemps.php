<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTemps extends Model
{
    use HasFactory;

    public function up()
    {
        Schema::create('typetemps', function (Blueprint $table)
        {
            $table->id();
            $table->string('type', 30);
            $table->timestamps();     
        });
    }

    public function plageDeTemps() : HasMany
    {
        return $this->hasMany('App\PlageDeTemps');
    }
}