<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    use HasFactory;

    //書き換え許可
    protected $fillable = ['health_date', 'energy', 'appetite', 'toilets', 'walk_minutes', 'weight'];

    public function pet() {
        return $this->belongsTo('App\Pet', 'pet_id', 'id');
    }
}
