@extends('layouts.main')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-12">

        
<div class="card border-1 bg-light">
  <center>  <img class="card-img-top mt-2" style="width: 720px; border-radius:2%" height="100%" src="{{asset('uploads/cover_image')}}/{{$company->display_picture}}" alt=""></center>
    
    <div class="card-body bg-light">
        <center><p class="card-text ml-2 bg-info" style="color:white">
            Website: {{$company->website}} | Address: {{$company->address}} | Phone: {{$company->phone}}
        </p>
      </center>
        <div>
    <img class="card-img-top" style="width: 100px;" height="100px" src="{{asset('uploads/company_logo')}}/{{$company->logo}}" alt="">
    <span style="font-size: 20px;"><u>{{$company->company_name}} </u></span>
  </div>

    <p class="card-text ml-2"> {{$company->description}}</p>
    <div class="card-body">
     <h3>Related jobs</h3>
      <table class="table bg-white">
        
        <tbody>
            @foreach ($company->jobs as $job)
            <tr>
            {{-- <td><img src="{{asset('uploads/company_logo')}}/{{$job->company->logo}}" width="70px" alt=""></td> --}}
                <td>position:{{$job->position}}
                    <br>
                    <i class="fa fa-clock-o" ></i>&nbsp;{{$job->type}}
                </td>
                <td><i class="fa fa-map-marker" aria-hidden="true"> </i>&nbsp;Address:{{$job->address}}</td>
            <td><i class="fa fa-globe" aria-hidden="true">&nbsp;{{$job->created_at->diffForHumans()}}</td>
            <td><a href="{{route('job.show',[$job->id,$job->slug])}}" class="btn btn-success btn-sm">Apply</a></td>
            </tr>
            @endforeach

        </tbody>
    </table>
   

    </div>
    </div>
  </div>
</div>
   </div>
</div>




@endsection
