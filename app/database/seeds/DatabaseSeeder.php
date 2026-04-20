<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            AdminSeeder::class,
            VetSeeder::class,
            UserSeeder::class,
            PetSeeder::class,
            HealthSeeder::class,
            VisitSeeder::class,
        ]);
    }
}
