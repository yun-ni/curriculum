<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon; // Carbon::now()のuse宣言
use Illuminate\Support\Facades\DB; // DB::table(...)のuse宣言
use App\User;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first(); // Usersテーブルから最初の1件を取得

        $params = [
            'name' => 'くうさん',
            'birth_date' => '2021-06-25',
            'gender' => 1, // TINYINT型
            'profile_image' => 'images/kuusan.png',
            'user_id' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('pets')->insert($params);
    }
}
