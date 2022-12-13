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
            
            [
                'type' => '0',
                'conducteur_id' => 1,
                'message' => '(Test) Vous n\'avez pas eu au moins 24 heures de repos d\'affilée au cours des 14 derniers jours, veuillez contacter votre contremaître.',
                'actif' => '1',
                'date' => '2021-01-01',
                'idEmploye' => 0,
            ],

            [
                'type' => '0',
                'conducteur_id' => 1,
                'message' => '(Test) Le conducteur Jean Buteau n\'a pas eu au moins 24 heures de repos d\'affilée au cours des 14 derniers jours.',
                'actif' => '1',
                'date' => '2021-01-01',
                'idEmploye' => 1,
            ],

        ]);
    }
}
