<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conducteur extends Model
{
    use HasFactory;

    public function up()
    {
        Schema::create("conducteurs", function (Blueprint $table) {
            $table->id();
            $table->boolean("actif");
            $table->string("prenom", 20);
            $table->string("nom", 20);
            $table->string("matricule", 6);
            $table->string("adresseCourriel", 80);
            $table->text("");

        });  
    }




}
