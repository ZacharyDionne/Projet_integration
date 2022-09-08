<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class FichesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fiches')->insert([
            [
                'id'=> 1,
                'observation'=> 'Retard (attente) chez le client Bellemare, Trois-Rivières',
                'cycle'=> 1,
                'date'=>'2022-05-10',
                'complete'=>true
            ],

            [
                'id'=> 2,
                'observation'=> 'Rendez-vous médecin (terminer plus tôt)',
                'cycle'=> 1,
                'date'=>'2022-05-11',
                'complete'=>false
            ],
        ]);
    }
}