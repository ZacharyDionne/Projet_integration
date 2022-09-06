<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiche extends Model
{
    use HasFactory;


    public function conducteur() : BelongsTo
    {
        return $this->belongsTo("App/Models/Conducteur");
    }

    public function up()
    {
        Schema::create('fiches', function (Blueprint $table)
        {
            $table->id();
            $table->string('observation', 255);
            $table->string('cycle', 12);
            $table->date('date');
            $table->boolean('complete');
            $table->timestamps();     
        });
    }
}
