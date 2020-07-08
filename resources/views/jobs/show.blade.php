@extends('layouts.main')

@section('content')
<div style="height: 113px;"></div>

<div class="container">

  <div class="row" id='app'>
      <div class="col-md-8">
          @if (Session::has('message'))
          <div class="alert alert-success">
              {{Session::get('message')}}
          </div>
           @endif
          <div class="card">
              <div class="card-header">{{$job->title}}
                  <span style="float: right">
                  <a href=" {{route('company.show',[$job->company->id,$job->company->slug]) }}">Visit {{$job->company->company_name }}</a>
                  </span>
              </div>
              {{-- <div class="card-body">
                  <ul>
                      <li>
                          Employment type : {{$job->type}}
                      </li>
                  </ul>
              <p><h4><u>Description</u></h4>{{$job->description}}</p>
              <p><h4><u>Roles and Responsibilties</u></h4>{{$job->roles_responsibilities}}</p>
                 
              </div>   --}}
                
              <div class="card-body">
                  <div class="card-group">
                  <div class="card border-0">
                  <div class="card-header p-2"><h3 class="mb-1 h6"><strong>Basic Job Information</strong></h3></div>
                  <div class="card-body p-0 table-responsive">
                       <table class="table table-hover table-no-border m-0">
                           <tbody>
                              <tr>
                                <td width="33%">Job Category</td>
                                <td width="3%">:</td>
                                <td width="64%">
                                    <a href="">Category</a>
                              </td>
                            </tr>
                             <tr>
                               <td>Job position</td>
                               <td>:</td>
                               <td>
                               <a href="">{{$job->position}}</a>
                               </td>
                           </tr>
                  <tr>
                  <td>Employment Type</td>
                  <td>:</td>
                  <td>
                      {{$job->type}}
                  </td>
                  </tr>
                  <tr>
                  <td>Job Location</td>
                  <td>:</td>
                  <td>
                  <span class="clearfix">{{$job->address}}</span>
                  </td>
                  <tr>
                    <td>Salary</td>
                    <td>:</td>
                    <td>
                    <span class="clearfix">{{$job->salary}}-/ per month</span>
                    </td>

                    <tr>
                      <td>Experience</td>
                      <td>:</td>
                      <td>
                      <span class="cleearfix">{{$job->experiences}} years</span>
                      </td>
                  </tr>
                  <tr>
                    <td>Gender</td>
                    <td>:</td>
                    <td>
                    <span class="clearfix">{{$job->gender}}</span>
                    </td>
                  <tr>
                  <td>Apply Before<span class="mx-2">(Deadline)</span></td>
                  <td>:</td>
                  <td>{{$job->deadline}}
                  {{-- ( {{$job->deadline->diffForHumans()}} ) --}}
                  </td>
                  </tr>
                  </tbody></table>
                  </div>
                  </div>
                  </div>
              </div>
             
              <div class="card-header p-2"><h3 class="mb-1 h6"><strong>Job Description</strong></h3></div>
              <div class="card-body p-0 table-responsive">
                  <table class="table table-hover table-no-border m-0">
                      <tbody>
                         <tr>
                         <td width="33%">{{$job->description}}</td>     
             </td>
             </tr>
             </tbody></table>
             </div>
             <div class="card-header p-2"><h3 class="mb-1 h6"><strong>Roles and responsibilities</strong></h3></div>
             <div class="card-body p-0 table-responsive">
                 <table class="table table-hover table-no-border m-0">
                     <tbody>
                        <tr>
                        <td width="33%">{{$job->roles_responsibilities}}</td>     
            </td>
            </tr>
            </tbody></table>
            </div>
      </div>
          </div>
      <div class="col-md-4">
          <div class="card">
              <div class="card-header">Job Action</div>
              <div class="card-body">
                  @if(Auth::check() && Auth()->user()->user_type=="seeker")
                  <div class="mb-2">
                      @if (!$job->ifJobApplied())
                      {{-- <form action="{{ route('apply',[$job->id])}}" method="post">
                         @csrf
                         <button type="submit" class="btn btn-success btn-block">APPLY NOW</button>
                         
                     </form> --}}

                     <application-component jobid={{$job->id}} job={{$job->slug}} ></application-component>

                     <br>
                      @else
                      <p style="color: black">Your already applied for this job</p>
                      @endif
                      <wish-component jobid={{$job->id}} ifwish={{$job->ifJobWished()? true:false}} ></wish-component>
                  @else
                  <div class="text-center">
                      <p style="color: black">Login/Sign up as seeker to apply for this Job.</p>
                      <a href="{{route('login')}}" class="btn btn-outline-info mr-1">Login</a>
                      <a href="{{route('register')}}" class="btn btn-info">Register Now</a>
                  </div>  
                  @endif    
              </div>
          </div>
      </div> 
</div>
</div>
<div style="height: 113px;"></div>
</div>


 
@endsection
