{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
@section('content')
@if ($applications)
@foreach ($applications as $application)
<div class="card">
  <p>Job application</p>

    <div class="card-header">{{\App\Job::find($application['job_id'])->title}}</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Bio</th>
                    <th scope="col">Similarity</th>
                    <th scope="col">resume</th>
                    <th scope="col">cover</th>
                  </tr>
                </thead>
                <tbody>
            @foreach ($application['bios'] as $bio)
              @php($user=\App\User::find($bio->id))
              
                  <tr>
                  <th>{{ $loop->iteration}}</th>
                    
                  <th>{{ $user->name}}</th>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->profile->address}}</td>
                    <td>{{ $user->profile->bio}}</td>
                    <td>{{number_format($bio->similarity*100,2)}}%</td>
                    <td><a href="{{ Storage::url($user->profile->resume)}}">Download </a></td>
                    <td><a href="{{ Storage::url($user->profile->cover_letter)}}">Download</a></td>

                  </tr>
               
               @endforeach

                </tbody>
              </table>
              
              
            </div>
        </div>
        <br>
        @endforeach
    </div>
    @stop
        
    @else
    <p>No applications till now</p>
   @endif
@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



