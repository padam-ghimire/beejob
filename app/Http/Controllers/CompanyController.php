<?php

namespace App\Http\Controllers;
use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    
    public function __construct(){
        $this->middleware(['employer','verified'],['except'=>[
            'show'
        ]]);
    }


    public function show($id,Company $company){

        // $company  = Company::findOrFail($id);
        ;
        // return $company;
        return view('company.show',compact('company'));

    }

    public function profile(){

        return view('company.profile');

    }

    public function update(){

        $user_id = auth()->user()->id;
        Company::where('user_id',$user_id)->update([
             'address' =>request('company_address'),
             'website'=>request('company_website'),
             'phone'=>request('company_phone'),
             'description'=>request('company_description'),
             'slogan'=>request('company_slogan')
        ]);

        return redirect()->back()->with('msg',"Company details has been updated.");
    }
    


    public function update_cover(Request $request){


        
        $user_id = auth()->user()->id;

       
            $this->validate($request,[
                'cover_image' =>'required|image|mimes:jpeg,jpg,png,gif|dimensions:width=720,height=200'
            ]
        );


            $file = $request->file('cover_image');
            $extension = $file->getClientOriginalExtension();
            $file_name = rand().time().'.'.$extension;
            if(auth()->user()->company->display_picture != null) {
                unlink(public_path().'/uploads/cover_image/'.auth()->user()->company->display_picture);
            }
            $file->move('uploads/cover_image/',$file_name);

            Company::where('user_id',$user_id)->update([
                'display_picture' => $file_name
            ]);
            return redirect()->back()->with('msg',"Cover Image has been updated.");


    }

    public function logo_update(Request $request){

          
        $user_id = auth()->user()->id;

       
            $this->validate($request,[
                'company_logo' =>'required|image|mimes:jpeg,jpg,png,gif'
            ]
        );
        
            $file = $request->file('company_logo');
            $extension = $file->getClientOriginalExtension();
            $file_name = rand().time().'.'.$extension;
            if(auth()->user()->company->logo != null) {
                unlink(public_path().'/uploads/company_logo/'.auth()->user()->company->logo);
            }
            $file->move('uploads/company_logo/',$file_name);

            Company::where('user_id',$user_id)->update([
                'logo' => $file_name
            ]);
            return redirect()->back()->with('msg',"Logo has been updated.");

    }
}
