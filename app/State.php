<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    // protected $table = 'states';
    protected $table = 'oc_zone';
    public $timestamps = false;

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
