<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AlertesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alertes')->insert([
            'type' => 0,
            'conducteur_id' => 1,
            'message' => 'Alerte 1',
            'actif' => 1,
            'date' => '2022-09-15',
            'idEmploye' => 1,
        ]);
        DB::table('alertes')->insert([
            'type' => 1,
            'conducteur_id' => 2,
            'message' => 'Alerte 2',
            'actif' => 1,
            'date' => '2022-09-16',
            'idEmploye' => 2,
        ]);
        DB::table('alertes')->insert([
            'type' => 2,
            'conducteur_id' => 3,
            'message' => 'Alerte 3',
            'actif' => 0,
            'date' => '2022-09-17',
            'idEmploye' => 3,
        ]);
        DB::table('alertes')->insert([
            'type' => 1,
            'conducteur_id' => 3,
            'message' => 'Alerte 4',
            'actif' => 0,
            'date' => '2022-09-18',
            'idEmploye' => 4,
        ]);
    }
}
