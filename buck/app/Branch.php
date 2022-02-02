<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table ="branches";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
