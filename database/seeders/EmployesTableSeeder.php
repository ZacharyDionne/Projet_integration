<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class EmployesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("employes")->insert([
            [
                "id" => 1,
                "matricule" => "123478",
                "prenom" => "Martin", 
                "nom" => "Rivard", 
                "adresseCourriel" => "martin.rivard.01@gmail.com",
                //mot de passe: 123456
                "motDePasse" => '$2y$10$kLyHxYK6k549.E9zK2GfFePbOSDV78mTUU8mOdl2rK7wVcxqbdNoq',
                "actif" => true,
                "type_id"=>1,
            ],

            [
                "id" => 2,
                "matricule" => "123121",
                "prenom" => "Robert", 
                "nom" => "Lafontaine", 
                "adresseCourriel" => "robert.lafontaine.01@outlook.com",
                //mot de passe: 123456
                "motDePasse" => '$2y$10$kLyHxYK6k549.E9zK2GfFePbOSDV78mTUU8mOdl2rK7wVcxqbdNoq',
                "actif" => true,
                "type_id"=>2,
            ],
        ]);
    }
}
