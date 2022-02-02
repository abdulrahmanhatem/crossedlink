<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';
    // Primary Key 
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
    
    public function sender()
    {
        return $this->belongsTo(User::class);
    }
}
