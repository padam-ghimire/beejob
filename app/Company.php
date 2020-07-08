<?php

namespace App;
use App\Job;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //

        protected $fillable =[
            'user_id',
            'company_name',
             'address',
             'website',
             'phone',
             'slug',
             'logo',
             'display_picture',
             'description',
             'slogan'
        ];

  

    public function jobs(){
        return $this->hasMany(Job::class);
    }
    public function getRouteKeyName(){
        return 'slug';
    }


}
