{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Add new Category</p>
    <div class="container">
       
            <div class="col-md-8">
               
                <div class="card-body">
                <form action="{{ route('category.update',$category->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                        <input name="name" type="text" value="{{$category->name}}" class="form-control @error('name') is-invalid @enderror" >
                            @if($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name')}}</strong>
                            </span>
                        @endif
                            
    </div>
    <button class="btn btn-success" type="submit">Post</button>
                </form>
                </div>
            </div>
    </div>
    
                
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop