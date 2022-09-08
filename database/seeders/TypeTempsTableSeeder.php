<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;


class TypeTempsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('typeTemps')->insert([
            [
                'id'=> 1,
                'type'=> 'Repos'
            ],

            [
                'id'=> 2,
                'type'=> 'Travail hors conduite'
            ],

            [
                'id'=> 3,
                'typeTemps'=> 'Travail en conduite'
            ],
            ]);
    }
}
