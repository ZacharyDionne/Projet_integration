<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PlageDeTempsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plagedetemps')->insert([
            [
                'id'=> 1,
                'heureDebut'=> '06:00:00',
                'heureFin'=> '15:15:00',
                'typetemps_id'=> 3,
                'fiche_id'=>1,
            ],

            [
                'id'=> 2,
                'heureDebut'=> '7:15:00',
                'heureFin'=> '15:00:00',
                'typetemps_id'=> 1,
                'fiche_id'=>2,
            ],

            [
                'id'=> 3,
                'heureDebut'=> '06:00:00',
                'heureFin'=> '17:00:00',
                'typetemps_id'=> 3,
                'fiche_id'=>2,
            ],
        ]);

    }
}
