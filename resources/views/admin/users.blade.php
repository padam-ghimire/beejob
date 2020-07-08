


  {{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>All Users</p>

    <table class="table">
        <thead class="thead-dark">
          <tr>
            {{-- <th scope="col"></th> --}}
            <th scope="col">Name</th>
            <th scope="col">registered dated</th>
            <th scope="col">Type</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
              
          <tr>
            {{-- <th>1</th> --}}
            <td>{{$user->name}}</td>
          <td>{{$user->created_at}}</td>
          <td>{{$user->user_type}}</td>
          </tr>
          
          @endforeach
         
        </tbody>
      </table>
      
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop




