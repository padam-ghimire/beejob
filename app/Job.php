<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

        protected $fillable=[
            'user_id',
            'company_id',
            'category_id',
            'title',
            'position',
            'address',
            'type',
            'roles_responsibilities',
            'description',
            'slug',
            'status',
            'deadline',
            'vacancies',
            'salary',
            'gender',
            'experiences'
        ];

        public function getRouteKeyName(){
            return 'slug';
        }

        public function company(){
            return $this->belongsTo('App\Company');
        }
        public function category(){
            return $this->hasOne(Category::class);
        }

        public function users(){
            return $this->belongsToMany(User::class)->withTimeStamps();   
         }

         public function wishes(){
            return $this->belongsToMany(Job::class,'favourites','job_id','user_id')->withTimeStamps();   
         }
         


        public function ifJobApplied(){
            return \DB::table('job_user')->where('user_id',auth()->user()->id)->where('job_id',$this->id)->exists();
        }

        public function ifJobWished(){
            return \DB::table('favourites')->where('user_id',auth()->user()->id)->where('job_id',$this->id)->exists();
        }





    
}
