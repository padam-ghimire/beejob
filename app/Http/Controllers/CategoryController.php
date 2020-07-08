<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Category;
class CategoryController extends Controller
{
    //

    public function index($id){

        $jobs= Job::where('category_id',$id)->paginate(5);
        $catName= Category::where('id',$id)->first();
        return view('category.index',compact('jobs','catName'));
    }
}
