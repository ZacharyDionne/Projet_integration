<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string("matricule", 6);
            $table->foreignId('type_id')->constrained();
            $table->string("prenom", 20);
            $table->string("nom", 20);
            $table->string("adresseCourriel", 80)->unique();
            $table->text("motDePasse");
            $table->boolean("actif");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employes');
    }
};
