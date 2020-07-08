<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Company;
use Storage;


class UserProfileController extends Controller
{
    
    public function __construct(){
        $this->middleware(['seeker','verified']);
    }


    public function index(){


        return view('userprofile.index');

    }

    public function store(Request $request){

        $user_id = auth()->user()->id;

        Profile::where('user_id',$user_id)->update([
            'address' => request('address'),
            'experience' => request('experience'),
            'bio' => request('bio')
        ]);

        return redirect()->back()->with('msg',"Profile has been updated.");

    }

    public function coverupdate(Request $request){

        $this->validate($request,[
            'cover_letter' =>'required|mimes:docx,doc,pdf'
        ]
    );

        $user_id = auth()->user()->id;
        $cover = $request->file('cover_letter')->store('public/files');
        Profile::where('user_id',$user_id)->update([
            'cover_letter' => $cover
        ]);
        return redirect()->back()->with('msg',"Cover Letter has been updated.");

    }

    public function resumeupdate(Request $request){
        $this->validate($request,[
            'resume' =>'required|mimes:doc,docx,pdf'
        ]
    );

        $user_id = auth()->user()->id;
        // if(url(auth()->user()->profile->resume) != null) {
        //     unlink(public_path().Storage::url(Auth()->user()->profile->cover_letter));
        // }
        $resume = $request->file('resume')->store('public/files');
        Profile::where('user_id',$user_id)->update([
            'resume' => $resume
        ]);
        return redirect()->back()->with('msg',"Resume has been updated.");
    }

    public function profileImageUpdate(Request $request){


        $user_id = auth()->user()->id;

       
            $this->validate($request,[
                'pp' =>'required|image|mimes:jpeg,jpg,png,gif'
            ]
        );


            $file = $request->file('pp');
            $extension = $file->getClientOriginalExtension();
            $file_name = rand().time().'.'.$extension;
            if(auth()->user()->profile->avatar != null) {
                unlink(public_path().'/uploads/profile_image/'.auth()->user()->profile->avatar);
            }
            $file->move('uploads/profile_image/',$file_name);

            Profile::where('user_id',$user_id)->update([
                'avatar' => $file_name
            ]);
            return redirect()->back()->with('msg',"Profile Image has been updated.");


    }

    public function reset(Request $request){

        if(auth()->user()->user_type=='seeker'){
        $user_id = auth()->user()->id;
        $data =Profile::where('user_id',$user_id);
        $data->update([
            'address' =>null,
            'resume' =>null,
            'experience' =>null,
            'cover_letter' =>null,
            'avatar' =>null,
            'bio' =>null,
        ]);
        if(auth()->user()->profile->avatar != null) {
            unlink(public_path().'/uploads/profile_image/'.auth()->user()->profile->avatar);
        }
        return redirect()->back();
        
    }else{
        $user_id = auth()->user()->id;
        $data =Company::where('user_id',$user_id);
        $data->update([
 
             'address'=>null,
             'website'=>null,
             'phone'=>null,
             'phone'=>null,
             'logo'=>null,
             'display_picture'=>null,
             'description'=>null,
             'slogan'=>null
        ]);
        if(auth()->user()->company->display_picture != null) {
            unlink(public_path().'/uploads/company_logo/'.auth()->user()->company->display_picture);
        }
        return redirect()->back();

}
    }

}
