<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeur extends Model
{
    use HasFactory;

    public function up()
    {
        Schema::create("employeurs", function (Blueprint $table) {
            $table->id();
            $table->string("prenom", 20);
            $table->string("nom", 20);
            $table->string("adresseCourriel", 80);
            $table->text("motDePasse");
            $table->timestamp();
        });  
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }
}
