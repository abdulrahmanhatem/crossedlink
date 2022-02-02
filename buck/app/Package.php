<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    public function pricingRequests()
    {
        return $this->hasMany(PricingRequest::class);
    }
}
