<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table ="education";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
