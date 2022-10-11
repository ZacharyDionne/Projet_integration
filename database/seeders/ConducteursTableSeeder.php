<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ConducteursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conducteurs')->insert([
            [
                'id'=> 1,
                'actif'=> true,
                'prenom'=> 'Jean',
                'nom'=> 'Buteau',
                'matricule'=> '165293',
                'adresseCourriel'=> 'j.buteau@v3r.net',
                'motDePasse'=> '123456',
            ],

            [
                'id'=> 2,
                'actif'=> false,
                'prenom'=> 'Betty',
                'nom'=> 'Gendron',
                'matricule'=> '201943',
                'adresseCourriel'=> 'b.gendron@v3r.net',
                'motDePasse'=> '567892',
            ],
        ]);
    }
}
