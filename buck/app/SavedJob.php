<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SavedJob extends Model
{
    protected $table = 'saved_jobs';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
