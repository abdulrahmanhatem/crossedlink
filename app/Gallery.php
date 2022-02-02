<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
