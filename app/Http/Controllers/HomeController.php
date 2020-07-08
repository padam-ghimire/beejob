<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        if(Auth()->user()->roles()->pluck('type')->contains('admin')){
            return redirect('admin');

        }
        if(Auth()->user()->user_type=='company'){
            return redirect('jobs/company-jobs');

        }

        // if(Auth()->user()->user_type=='seeker'){
        //     return redirect('user/profile');

        // }


        $jobs = Auth()->user()->wishes;
        return view('home',compact('jobs'));
    }
}
