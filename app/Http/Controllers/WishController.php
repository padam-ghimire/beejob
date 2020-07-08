<?php

namespace App\Http\Controllers;

use App\Job;

use Illuminate\Http\Request;

class WishController extends Controller
{
    //


    public function wish($id){

        $job = Job::find($id);

        $job->wishes()->attach(auth()->user()->id);
        return redirect()->back();


    }


    public function unwish($id){
        $job = Job::find($id);
        $job->wishes()->detach(auth()->user()->id);
        return redirect()->back();


    }
}
