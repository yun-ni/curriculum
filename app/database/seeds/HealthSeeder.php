<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon; // Carbon::now()のuse宣言
use Illuminate\Support\Facades\DB; // DB::table(...)のuse宣言

class HealthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pet = DB::table('pets')->first(); // Petsテーブルから最初の1件を取得

        $params = [
            'health_date' => '2026-04-18',
            'energy' =>0,
            'appetite' => 0,
            'toilets' => 0,
            'walk_minutes' => 30,
            'weight' => 9.25,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'pet_id' => $pet->id,
        ];

        DB::table('healths')->insert($params);
    }
}
