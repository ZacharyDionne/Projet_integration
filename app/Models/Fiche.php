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
            $table->foreignId('conducteur_id')->constrained();
            $table->text('observation');
            $table->tinyInteger('cycle');
            $table->date('date');
            $table->timestamps();     
        });
    }
}
