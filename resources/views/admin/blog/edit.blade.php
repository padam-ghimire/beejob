{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Edit Blog</p>
    <div class="container">
       
            <div class="col-md-8">
                <div class="card">
                    {{-- <div class="card-header">New Blog</div> --}}
                </div>
                <div class="card-body">
                <form action="{{ route('blog.update',$blog->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                        <input name="title" type="text" value="{{$blog->title}}" class="form-control @error('title') is-invalid @enderror" >
                            @if($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title')}}</strong>
                            </span>
                        @endif
                            <label for="content">Content</label>
                        <textarea class="form-control @error('title') is-invalid @enderror" id="" cols="30" rows="10" name="content">{{$blog->content}}</textarea>
                        @if($errors->has('content'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('content')}}</strong>
                        </span>
                    @endif
                            <label for="">Image</label>
                            <br>
                            <img src="{{asset('storage/'.$blog->image)}}" width="75">
                            <br>
                            <input type="file" class="form-control"name='image'>
                            @if($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image')}}</strong>
                            </span>
                        @endif
                            <label for="">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1" {{$blog->status==1 ?'selected':''}}>live</option>
                                <option value="0" {{$blog->status==0 ?'selected':''}}>draft</option>
                            </select>
                            @if($errors->has('status'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('status')}}</strong>
                            </span>
                        @endif
                            <br>
                            <button class="btn btn-success" type="submit">Post</button>
                        </div>
                    </form>
                </div>
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