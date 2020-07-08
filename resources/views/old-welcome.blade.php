@extends('layouts.app')

@section('content')
<div class="container">
    <search-component></search-component>
    <div class="row">
        <h1>Popular jobs</h1>
        <table class="table bg-white">
            <thead>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                <tr>
                <td><img src="{{asset('uploads/company_logo')}}/{{$job->company->logo}}" width="70px" alt=""></td>
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
        {{-- {{ $jobs->links() }} --}}
   
    </div>
<a href="{{ route('jobs')}}" class="btn btn-outline-success btn-block">Browser all Jobs</a>

<div class="conatainer m-2">
    <div class="row">
        @foreach ($companies as $company)
        <div class="col-md-4">
                
            <div class="card mt-2" style="width: 18rem; ">
            <center> <img  class="card-img-top mt-2" style="width: 100px;" height="100px" src="{{asset('uploads/company_logo')}}/{{$company->logo}}" alt="{{$company->name}}"></center>

                <div class="card-body">
                <h5 class="card-title">{{$company->company_name}}</h5>
                <p class="card-text">{{str_limit($company->description,100)}}</p>
                <a href="{{ route('company.show',[$company->id,$company])}}" class="btn btn-block btn-outline-success">Visit Company</a>
                </div>
              </div>
            </div>
            @endforeach
    </div>
</div>
</div>
@endsection
