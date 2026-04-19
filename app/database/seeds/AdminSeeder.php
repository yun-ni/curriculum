<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon; //Carbon::now()のuse宣言
use Illuminate\Support\Facades\DB; //DB::table(...)のuse宣言
use Illuminate\Support\Str; //Str::random(10)のuse宣言
use Illuminate\Support\Facades\Hash; //パスワードのハッシュ化

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => '管理者',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin01'),
            'remember_token' => Str::random(10), //ランダムトークンを設定
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
