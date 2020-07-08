@extends('layouts.main')

@section('content')
<div class="container mt-10">
    <div class="row ">




    <h1>{{$catName->name}}</h1>
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
        {{ $jobs->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
   
    </div>

</div>
@endsection
