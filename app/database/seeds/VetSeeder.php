<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon; //Carbon::now()のuse宣言
use Illuminate\Support\Facades\DB; //DB::table(...)のuse宣言
use Illuminate\Support\Str; //Str::random(10)のuse宣言
use Illuminate\Support\Facades\Hash; //パスワードのハッシュ化

class VetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            'name' => '獣医師 1',
            'email' => 'vet01@gmail.com',
            'password' => Hash::make('vet01'),
            'remember_token' => Str::random(10), //ランダムトークンを設定
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
            
        DB::table('vets')->insert($params);
    }
}
