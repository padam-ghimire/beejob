@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Auth()->user()->user_type=='seeker')
            @if($jobs->count()==0)
            <p>No Have not added any job to your wish list</p>
            @else
            @foreach ($jobs as $job)
            <div class="card mb-4">
                <div class="card-header">  {{$job->title}} </div>
                <div class="card-body">
                    <div>
                    Position: <strong>
                        {{$job->position}}
                    </strong>

                    </div>
                    {{$job->description}}

                     
                     
                    </div>
                  
                <div class="card-footer float-left">

                    <div class="float-right"><a href="{{route('job.show',[$job->id,$job->slug])}}"> Visit Job </a></div>
                    Deadline: {{$job->deadline}}</div>
                </div>
                @endforeach
                @endif
                @endif
        </div>
    </div>
</div>
@endsection
