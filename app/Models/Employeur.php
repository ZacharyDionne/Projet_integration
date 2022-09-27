<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeur extends Model
{
    use HasFactory;

    protected $fillable = ['actif', 'prenom', 'nom', 'type_id', 'adresseCourriel', 'motDePasse'];

    public function up()
    {
        Schema::create("employeurs", function (Blueprint $table) {
            $table->id();
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
}
