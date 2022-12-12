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
            'type' => '2',
            'conducteur_id' => 1,
            'message' => 'La fiche du dimanche, 4 décembre 2022 n\'est pas complète. Veuillez la compléter.',
            'actif' => '1',
            'date' => '2021-01-01',
            'idEmploye' => 1,
        ]);
    }
}
