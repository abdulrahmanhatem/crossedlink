<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{

    protected $table = "job_requsets";

    public function worker()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
