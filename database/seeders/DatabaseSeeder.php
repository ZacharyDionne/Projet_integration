<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeTempsTableSeeder::class);
        $this->call(PlageDeTempsTableSeeder::class);

        $this->call(ConducteursTableSeeder::class);
        $this->call(FichesTableSeeder::class);

        $this->call(EmployeursTableSeeder::class);
        $this->call(TypesTableSeeder::class);

        //$this->call(AlertesTableSeeder::class);

       

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
