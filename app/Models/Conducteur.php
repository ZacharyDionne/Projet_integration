<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Conducteur extends Model implements Authenticatable
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






/**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return "id";
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->attributes["id"];
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return false;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {

    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return false;
    }













}
