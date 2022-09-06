<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlageDeTemps extends Model
{
    use HasFactory;

    public function up()
    {
        Schema::create('plagesdetemps', function (Blueprint $table)
        {
            $table->id();
            $table->time('heureDebut');
            $table->time('heureFin');
            $table->integer('type',1);
            $table->timestamps();     
        });
    }
}
