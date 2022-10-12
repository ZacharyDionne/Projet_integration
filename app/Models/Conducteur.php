<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Conducteur extends User
{
    use HasFactory;

    protected $fillable = ['actif', 'prenom', 'nom', 'matricule', 'adresseCourriel', 'motDePasse'];

    public function fiches() : HasMany
    {
        return $this->hasMany("App/Models/Fiche");
    }

    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    protected $password = "motDePasse";



    public function up()
    {
        Schema::create("conducteurs", function (Blueprint $table) {
            $table->id();
            $table->boolean("actif");
            $table->string("prenom", 20);
            $table->string("nom", 20);
            $table->string("matricule", 6);
            $table->string("adresseCourriel", 80);
            $table->text("motDePasse");
            $table->timestamps();
        });  
    }














}
