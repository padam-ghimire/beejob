<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use App\Company;
use App\User;
use Hash;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    //


    public function register_employer(Request $request){


            $this->validate($request,[
                'company_name' =>'required|string|max:255',
                'email' => 'required|email|string|unique:users',
                'password' => 'required|min:6|confirmed'
            ]);

        if(request('user_type')=='company'){
            $user = User::create([
                'email' => request('email'),
                'password' => Hash::make(request('password')),
                'user_type' => request('user_type')
            ]);
        
            Company::create(
                [
                    'user_id' => $user->id,
                    'company_name' => request('company_name'),
                    'slug' => str_slug(request('company_name'))
                    
                ]
            );

            $user->sendEmailVerificationNotification();

            return redirect()->to('login')->with('message','Please verifiy your email');

        }

    }


}
