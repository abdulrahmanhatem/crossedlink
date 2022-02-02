<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table ="experiences";

    public function worker()
    {
        return $this->belongsTo(User::class);
    }
}
