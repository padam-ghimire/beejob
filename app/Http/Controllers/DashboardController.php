<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Blog;
use App\Job;
use App\User;
use App\Category;

class DashboardController extends Controller
{
    //


    public function index(){

        $categories = Category::all()->count();
        $jobs = Job::all()->count();
        $users = User::all()->count();
        return view('admin.index',compact('categories','jobs','users'));


    }

    
    public function create(){


        return view('admin.blog.create');


    }
    public function createSeeker(){


        return view('admin.user.seeker');


    }

    public function createEmployer(){


        return view('admin.user.company');


    }

    public function createCategory(){
        return view('admin.category.create');

    }

    public function storeCategory(Request $request){
        $this->validate($request,[
            'name' =>'required|min:4',
        ]);

        Category::create([
            'name' => $request->get('name'),
            ]);

        return redirect('/admin/categories')->with('msg',"Category created successfully!");


    }

    public function categories(){

        $categories= Category::latest()->paginate(10);

        return view('admin.category.index',compact('categories'));

    }

    public function users(){

        $users= User::all();
        return view('admin.users',compact('users'));


    }

    public function editCategory($id){
        $category = Category::find($id);

        return view('admin.category.edit',compact('category'));
    }

    public function updateCategory(Request $request,$id){
        $this->validate($request,[
            'name' =>'required|min:4',
            
        ]);
        Category::where('id',$id)->update([
            'name' => $request->get('name'),
           
            ]);

            return redirect('/admin/categories')->with('message',"Category updated successfully");

    }

    public function deleteCategory(Request $request){
        $id =$request->get('id');
        $category = Category::find($id);
        if($category->delete()){
            return redirect()->back()->with('message','Category deleted successfully.');
        }

    }

    public function blogs(){

        $blogs = Blog::latest()->paginate(10);
        return view('admin.blog.blogs',compact('blogs'));


    }

    public function showBlog($id){

        $blog = Blog::find($id);
        return view('blog.show',compact('blog'));


    }




    public function store(Request $request){

        $this->validate($request,[
            'title' =>'required|min:4',
            'content' =>'required',
            'image' =>'required|mimes:jpg,jpeg,png',
            'status' =>'required|boolean',
        ]);
        if($request->hasFile('image')){

            $image =$request->file('image');

            $path= $image->store('uploads','public');
            if($path){

                Blog::create([
                    'title' => $request->get('title'),
                    'slug' => str_slug($request->get('title')),
                    'content' => $request->get('content'),
                    'image' => $path,
                    'status' =>  $request->get('status'),
                    ]);
            }


        }

        return redirect('/admin/blogs')->with('message',"Blog create successfully");


    }


    public function destroy(Request $request){

        $id =$request->get('id');
        $blog = Blog::find($id);
        if($blog->delete()){
            return redirect()->back()->with('message','Blog deleted successfully.');
        }

        
    }



    public function edit($id){
        $blog = Blog::find($id);

        return view('admin.blog.edit',compact('blog'));
    }

    public function update($id,Request $request){

        $this->validate($request,[
            'title' =>'required|min:4',
            'content' =>'required'
        ]);
        if($request->hasFile('image')){

            $image =$request->file('image');

            $path= $image->store('uploads','public');
           

                Blog::where('id',$id)->update([
                    'title' => $request->get('title'),
                   
                    'content' => $request->get('content'),
                    'image' => $path,
                    'status' =>  $request->get('status'),
                    ]);
            

                    
                }
                $this->NoImageUpdate($id,$request);

        return redirect('/admin/blogs')->with('message',"Blog update successfully");

    }
    
    public function NoImageUpdate($id,Request $request){

        return Blog::where('id',$id)->update([
            'title' => $request->get('title'),
           
            'content' => $request->get('content'),
            // 'image' => $path,
            'status' =>  $request->get('status'),
            ]);

    }

    public function bin(){

        $blogs= Blog::onlyTrashed()->paginate(10);

        return view('admin.blog.bin',compact('blogs'));
    }


    public function restore($id){

        Blog::onlyTrashed()->where('id',$id)->restore();
        return redirect('/admin/blogs')->with('message',"Blog restored successfully");


    }

    public function changeStatus($id){
        $blog = Blog::find($id);
        $blog->status= !$blog->status;

        $blog->save();
        return redirect('/admin/blogs')->with('message',"Blog status changed successfully");

    }


    public function jobs(){
        $jobs= Job::where('status',1)->paginate(10);

        return view('admin.job.index',compact('jobs'));
    }

    public function jobApplications(){
        $jobs= Job::where('status',1)->paginate(10);

        return view('admin.job.index',compact('jobs'));
    }

    
    public function applications(){

        // $applications = Job::has('users')->where('user_id',Auth()->user()->id)->get();

        $applications = Job::whereHas('users')
        ->paginate(2);


        $data=[];
        foreach ($applications as $application){
            $bios=[];
            foreach ($application->users as $user){
                $bio=$user->profile->bio;
                array_push($bios,['bio'=>$bio,'id'=>$user->id]);
            }
            array_push($data,['job'=>['description'=>$application->description,'id'=>$application->id],'bios'=>$bios]);
        }


        $url = env('FLASK_URL');
        $data = array('query'=>\GuzzleHttp\json_encode($data));
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }
        $result = json_decode($result);
        $data=[];
        foreach ($result as $jobs){
            usort($jobs->bios, function($a, $b) { //Sort the array using a user defined function
                return $a->similarity > $b->similarity ? -1 : 1; //Compare the scores
            });
            array_push($data,['job_id'=>$jobs->job,'bios'=>$jobs->bios]);
        }
        (object)$applications=$data;



        // return $applications[1]['bios'][0]->similarity;
        return view('admin.job.jobapplications',compact('applications'));

    }
}
