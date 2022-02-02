<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'states';
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
