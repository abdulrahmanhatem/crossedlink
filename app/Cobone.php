<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cobone extends Model
{
    protected $table = 'cobones';
    public $timestamps = false;

    public function package()
    {
        return $this->hasMany(Package::class);
    }
}
