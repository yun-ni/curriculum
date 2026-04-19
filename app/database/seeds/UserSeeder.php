<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon; //Carbon::now()のuse宣言
use Illuminate\Support\Facades\DB; //DB::table(...)のuse宣言
use Illuminate\Support\Str; //Str::random(10)のuse宣言
use Illuminate\Support\Facades\Hash; //パスワードのハッシュ化

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            'name' => 'A',
            'email' => 'user01@gmail.com',
            'password' => Hash::make('user01'),
            'remember_token' => Str::random(10), //ランダムトークンを設定
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
            
        DB::table('users')->insert($params);
    }
}
