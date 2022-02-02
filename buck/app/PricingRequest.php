<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricingRequest extends Model
{
    protected $table = 'pricing_requests';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

}
