<?php

namespace App\Http\Controllers;
use App\Job;
use App\Company;
use App\Category;
use Auth;
use App\Blog;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct(){
        $this->middleware(['employer','verified'],['except'=>[
            'index',
            'show',
            'apply',
            'jobs',
            'search',
            // 'store'
        ]]);
    }

    public function index(){
        $jobs= Job::where('status',1)->latest()->paginate(5);
        $blogs= Blog::where('status',1)->paginate(5);
        // $random= Job::where('status',1)>paginate(5);


        $companies= Company::get()->random(9);

        $categories = Category::paginate(12);

        // return $categories;

        // return $blogs;

        return view('welcome',compact('jobs','categories','companies','blogs'));
    }

    public function show($id,Job $job){
        // $job= Job::find($id);
        return view('jobs.show',compact('job'));
    }


    public function create(){
        // $job= Job::find($id);
        return view('jobs.create');
    }

    public function store(Request $request){

        $user_id = auth()->user()->id;
        $company= Company::where('user_id',$user_id)->first();
        // $company_id = $company->id;

        $this->validate($request,[
            'title' =>'required|min:5|max:255',
            'position' =>'required|min:5|max:255',
            'vacancies' =>'required|integer',
            'address' =>'required|min:5|max:255',
            'type' =>'required',
            'gender' =>'required',
            'salary' =>'required',
            'status' =>'required|boolean',
            'roles_responsibilities' =>'required|min:10|max:255',
            'category' => 'required',
            'description' => 'required|min:15',
            'experiences' => 'required|min:15',
            'deadline' => 'required|date '


        ]
    );


         Job::create([
             'user_id' =>$user_id,
             'company_id' => auth()->user()->company->id,

                'category_id'=>request('category'),
                'title'=>request('title'),
                'position'=>request('position'),
                'vacancies'=>request('vacancies'),
                'salary'=>request('salary'),
                'gender'=>request('gender'),
                'address'=>request('address'),
                'type'=>request('type'),
                'status' =>request('status'),
                'roles_responsibilities'=>request('roles_responsibilities'),
                'description'=>request('description'),
                'experiences'=>request('experiences'),
                'slug'=>str_slug(request('title')),
                'deadline' =>request('deadline')
        ]);;

        // return "hello";
        return redirect()->back()->with('message',"Job has been posted!");

    }


    public function edit($id,Job $job){

        // return $job;
        return view('jobs.edit',compact('job'));

    }


    public function apply($id,Job $job){

        $job->users()->attach(Auth()->user()->id);
        return redirect()->back()->with('message',"Job has has been applied!");



    }

    public function applications(){

        // $applications = Job::has('users')->where('user_id',Auth()->user()->id)->get();

        $applications = Job::whereHas('users')->where('user_id', Auth()->user()->id)
        ->get();


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
        $applications=$data;
    $count = count($applications);


        // return $applications[1]['bios'][0]->similarity;
        return view('jobs.applications',compact('applications','count'));

    }

    public function update($id,Job $job, Request $request){
            // dd($request->all());
            $this->validate($request,[
            'title' =>'min:5|max:255',
            'position' =>'min:5|max:255',
            'address' =>'min:5|max:255',
            'type' =>'required',
            'status' =>'required|boolean',
            'roles_responsibilities' =>'min:10|max:255',
            'category_id' => 'required',
            'description' => 'min:15',
            'deadline' => 'required|date '
            ]
        );


            $job->update($request->all());

            return redirect()->back()->with('message',"Job has been Updated!");
        }



        public function search(Request $request){
           $keyword = $request->get('keyword');

            $jobs = Job::where('title','LIKE','%'.$keyword.'%')
            ->orWhere('position','LIKE','%'.$keyword.'%')->limit(6)->get();

            if($jobs){

                return response()->json($jobs);
            }else{
                return response()->json([

                        'message'=>"Job not found"

                ]);

            }



        }


        public function jobs(Request $request){

            $keyword = $request->get('title');
            $type = $request->get('type');
            $category = $request->get('category_id');
            $address = $request->get('address');

            if($keyword || $type || $category || $address){

                $jobs = Job::where('title','LIKE','%'.$keyword.'%')
                                ->orWhere('type',$type)
                                ->orWhere('category_id',$category)
                                ->orWhere('address',$address)
                                ->paginate(5);
                return view('jobs.jobs',compact('jobs'));


            }else{

                $jobs= Job::where('status',1)->paginate(5);
                return view('jobs.jobs',compact('jobs'));
            }


        }

}
