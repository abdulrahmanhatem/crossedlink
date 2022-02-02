<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
