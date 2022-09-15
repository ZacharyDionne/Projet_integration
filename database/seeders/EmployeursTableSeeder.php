<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class EmployeursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("employeurs")->insert([
            [
                "id" => 1, 
                "prenom" => "Martin", 
                "nom" => "Rivard", 
                "adresseCourriel" => "martin.rivard.01@gmail.com", 
                "motDePasse" => "1234",
                "actif" => true,
                "type_id"=>1,
            ],

            [
                "id" => 2, 
                "prenom" => "Robert", 
                "nom" => "Lafontaine", 
                "adresseCourriel" => "robert.lafontaine.01@outlook.com",
                "motDePasse" => "1234",
                "actif" => true,
                "type_id"=>1,
            ],
        ]);
    }
}
