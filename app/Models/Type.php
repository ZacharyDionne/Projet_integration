<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function up()
    {
        Schema::create('types', function (Blueprint $table)
        {
            $table->id();
            $table->string('nomType', 30);
            $table->timestamps();
        });
    }

    public function employeurs() : HasMany
    {
        return $this->hasMany('App\Employe');
    }
}
