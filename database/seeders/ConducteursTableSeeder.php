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
                //mot de passe: 123456
                'motDePasse'=> '$2y$10$TqnxnA4a.1hl/zv0TGcLEu.CJGb5TAUh/h9AZ1IdL9lOYKGH2AASq',
            ],

            [
                'id'=> 2,
                'actif'=> false,
                'prenom'=> 'Betty',
                'nom'=> 'Gendron',
                'matricule'=> '201943',
                'adresseCourriel'=> 'b.gendron@v3r.net',
                //mot de passe: 567892
                'motDePasse'=> '$2y$10$ASQtnsy0hcUfHfNf8JyR5OCbLw/6kFmV3f93lBH1T8DEtC8Wz8Mfq',
            ],

            [
                'id'=> 3,
                'actif'=> true,
                'prenom'=> 'Raphael',
                'nom'=> 'Bacon',
                'matricule'=> '201943',
                'adresseCourriel'=> 'raphbacon@gmail.com',
                //mot de passe: 1234
                'motDePasse'=> '$2y$10$xlBaqO4ia6jsOzRhgFBfO.Z4zfKhy.ViTNy0Ictr0XvQNXg5qwYxy',
            ],
        ]);
    }
}
