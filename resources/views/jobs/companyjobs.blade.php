@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if ($jobs->count()>0)
                    
                <div class="card-header">My Jobs</div>
                <div class="card-body">
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
                            <td>
                                @if (empty(Auth()->user()->company->logo))
                                <img class="float-left" src="{{asset('avatar/main.png')}}"  alt="profile Image" width="100" >
                                @else  
                                <img class=" rounded-circle" id="photo"  height="50" src="{{asset('uploads/company_logo')}}/{{Auth()->user()->company->logo}}" alt="" srcset="">
                                @endif
                            
                            </td>
                                <td>position:{{$job->position}}
                                    <br>
                                    <i class="fa fa-clock-o" ></i>&nbsp;{{$job->type}}
                                </td>
                                <td><i class="fa fa-map-marker" aria-hidden="true"> </i>&nbsp;Address:{{$job->address}}</td>
                            <td><i class="fa fa-globe" aria-hidden="true">&nbsp;{{$job->created_at->diffForHumans()}}</td>
                            <td><a href="{{route('job.edit',[$job->id,$job])}}" class="btn btn-success btn-sm">Edit</a></td>
                            </tr>
                            @endforeach
            
                        </tbody>
                    </table>
                </div>
                @else
                    <p>No jobs yet</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
