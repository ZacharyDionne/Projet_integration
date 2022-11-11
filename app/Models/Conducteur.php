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





}
