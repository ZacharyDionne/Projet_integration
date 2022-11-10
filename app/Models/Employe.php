<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Employe extends User
{
    use HasFactory;

    protected $fillable = ['actif', 'prenom', 'nom', 'type_id', 'adresseCourriel', 'motDePasse'];

    public function up()
    {
        Schema::create("employes", function (Blueprint $table) {
            $table->id();
            $table->string("matricule", 6);
            $table->foreignId('type_id')->constrained();
            $table->string("prenom", 20);
            $table->string("nom", 20);
            $table->string("adresseCourriel", 80);
            $table->text("motDePasse");
            $table->boolean("actif");
            $table->timestamps();
        });  
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }



    public function getAuthPassword()
    {
        return $this->motDePasse;
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
        return $this->id;
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
