<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
