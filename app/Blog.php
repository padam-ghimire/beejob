<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Blog extends Model
{
    use softDeletes;

    protected $fillable =['title','content','slug','image','status'];
}
