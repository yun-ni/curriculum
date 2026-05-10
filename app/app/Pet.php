<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory; //10行目の宣言
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    
    //書き換え許可
    protected $fillable = ['name', 'birth_date', 'breed', 'gender', 'profile_image'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function visits() {
        return $this->hasMany('App\Visit', 'pet_id', 'id');
    }

    public function healths() {
        return $this->hasMany('App\Health', 'pet_id', 'id');
    }
}
