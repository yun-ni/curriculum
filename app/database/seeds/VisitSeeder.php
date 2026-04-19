<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon; // Carbon::now()のuse宣言
use Illuminate\Support\Facades\DB; // DB::table(...)のuse宣言
use App\Models\Pet;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pet = Pet::first(); // Petsテーブルから最初の1件を取得

        $params = [
            'visit_date' => '2026-04-18',
            'has_visit' =>0,
            'hospital_name' => '夕やけの丘動物病院',
            'symptom' => 'アレルギー',
            'medication' => '投薬なし',
            'prescription' => '処方薬なし',
            'medical_fees' => '7200',
            'memo' => '処方薬にて様子見',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'pet_id' => $pet->id,
        ];

        DB::table('visits')->insert($params);
    }
}
