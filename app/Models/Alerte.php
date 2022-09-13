<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    use HasFactory;

    public function up()
    {
        Schema::create('alertes', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('conducteur_id')->constrained();
            $table->string('matricule', 6);
            $table->string('message', 255);
            $table->boolean('actif');
            $table->date('date');
            $table->bigInteger('idEmployeur')->nullable();
            $table->timestamps();
        });
    }
}
