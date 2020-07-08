{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')


<div class="register">
    @if (Session::has('msg'))
    <div class="alert alert-success">
        {{Session::get('msg')}}
    </div>
     @endif
    <div class="row">
       
        <div class="col-md-12 register-right">
         
            <div class="tab-content" id="myTabContent">
                {{-- <h3 class="register-heading">Apply as a Job seeker</h3> --}}
                {{-- <center> <img src="{{asset('avatar/logo.gif')}}" height="150"  alt=""/> </center> --}}
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <center> <h3 class="">Register as Employer</h3></center>


                    <form method="POST" action="{{ route('company.register') }}">
                        @csrf
                        <input type="hidden" name="user_type" value="company">

                    <div class="row register-form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="company_name" placeholder="Company name*" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" autocomplete="company_name" autofocus>

                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <input type="password"  id="password" placeholder="New Password *" class="form-control @error('password') is-invalid @enderror" name="password"   />
                                 @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                           
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input  placeholder="Your email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" id="password-confirm" placeholder="Confirm password *" class="form-control" name="password_confirmation"  autocomplete="new-password"/>
                               
                            </div>
                            <input type="submit" class="btnRegister"  value="Register"/>
                        </div>
                    </form>
                    </div>
                </div>



       
      
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop