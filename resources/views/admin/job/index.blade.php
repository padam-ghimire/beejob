{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Live jobs</p>


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
    {{$jobs->links()}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



