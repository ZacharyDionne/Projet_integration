<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("types")->insert([
            [
                "id" => 1,
                "typeEmp" => "contre-maître"
            ],

            
            [
                "id" => 2,
                "typeEmp" => "administrateur"
            ],
        ]);
    }
}
