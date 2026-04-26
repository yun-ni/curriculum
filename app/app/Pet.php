<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
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
