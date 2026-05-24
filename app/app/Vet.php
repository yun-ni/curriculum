<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vet extends Authenticatable
{
        // パスワードリセットなどの通知を送信
        use Notifiable;

        // パスワードのハッシュ化やログイン判定に必要なため、利用するテーブルやカラムを指定
        protected $table = 'vets';
    
        protected $fillable = [
            'name', 'email', 'password',
        ];
    
        protected $hidden = [
            'password',
        ];
}
