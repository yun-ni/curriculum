<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    public function pet() {
        return $this->belongsTo('App\Pet', 'pet_id', 'id');
    }
}
