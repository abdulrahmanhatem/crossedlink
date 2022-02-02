<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Table Name 
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password', 'country', 'first_name', 'middle_name', 'phone', 'website', 'role', 'company_name', 'nationality', 'category_id','email_verify_token','IsPhoneVerified', 'g-captcha', 'phone_code'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //   public function receivesBroadcastNotificationsOn()
    // {
    //     return 'App.User.2';
    // }

    public function isEmployer(){
        if($this->role != NULL) {
            if ($this->role == 2 || $this->role == 1 ) {
                return true;
            }
        }
        return false;
    }

    public function isWorker(){
        if($this->role != NULL) {
            if ($this->role == 0) {
                return true;
            }
        }
        return false;
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function socials()
    {
        return $this->hasMany(Social::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function pricingRequests()
    {
        return $this->hasMany(PricingRequest::class);
    }

    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class);
    }
    
    public function jobRequests()
    {
        return $this->hasMany(JobRequest::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class,'city','id')->select('name');
    } public function country()
    {
        return $this->belongsTo(Country::class,'country','code')->select('name');
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}
