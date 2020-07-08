@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
             @endif
             @if ($errors->any())
             <div class="alert alert-danger">
               
                    @foreach ($errors->all() as $error)
                        {{$error}} <br>
                    @endforeach
                
             </div>
         @endif
            <div class="card">
                <div class="card-header">
                    Create New Job
                </div>
                 <form action=" {{ route('job.update',[$job->id,$job])}}" method="post">
                    @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title:</label>
                         <input type="text" value="{{$job->title}}" name="title" class="form-control">
                  </div>
                <div class="form-group">
                    <label for="title">Position:</label>
                    <input value="{{$job->position}}" type="text" name="position" class="form-control">
                </div>

                <div class="form-group">
                    <label for="title">Vacancies:</label>
                    <input type="text" name="vacancies" value="{{$job->vacancies}}" class="form-control  @error('vacancies') is-invalid @enderror">
                    @error('vacancies')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                </div>

                <div class="form-group">
                    <label for="title">Salary:</label>
                    <input type="text" name="salary" value="{{$job->salary}}" class="form-control  @error('salary') is-invalid @enderror">
                    @error('salary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                </div>
        
                    <div class="form-group">
                        <label for="title">Address:</label>
                        <input value="{{$job->address}}" type="text" name="address" class="form-control">
                    </div>
                <div class="form-group">
                    <label for="title">Type:</label>
                    <select name="type" class="form-control" id="">
                    <option value="full_time" {{ $job->type=='full_time' ? 'selected' : ''}}>Full Time</option>
                    <option value="part_time" {{ $job->type=='part_time' ?  'selected' : ''}}>Part time</option>
                    <option value="freelancing" {{ $job->type=='freelancing' ?  'selected' : ''}}>Freelance</option>
                       
                    </select>
                </div>
                <div class="form-group">
                    <label for="catgory">Category:</label>
                    <select name="category_id" id="" class="form-control">
                        @foreach (App\Category::all() as $category)
                    <option value="{{ $category->id }}" {{$category->id==$job->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
        
                    </select>
                </div>
                  <div class="form-group">
                         <label for="roles_responsibilties">Roles and responsibilties:</label>
                    <textarea class="form-control" name="roles_responsibilities" id="roles_responsibilties">{{$job->roles_responsibilities}}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                        <textarea class="form-control" name="description" id="description" > {{$job->description}}</textarea>
                 </div>

                 <div class="form-group">
                    <label for="title">Experiences:</label>
                        <textarea class="form-control @error('experiences') is-invalid @enderror" name="experiences" id="experiences" >{{$job->experiences}}</textarea>
                        @error('experiences')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>

                 <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                        <option value="Open"  {{ $job->gender=='Open' ? 'selected' : ''}}>Open</option>
                        <option value="Male"  {{ $job->gender=='Male' ? 'selected' : ''}}>Male</option>
                        <option value="Female"  {{ $job->gender=='Female' ? 'selected' : ''}}>Female</option>
                    </select>
                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                     @enderror
                </div>
                 <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" class="form-control" id="">
                       
                         <option value="1" {{ $job->status=='1' ? 'selected' : ''}}>Live</option>
                         <option value="0" {{ $job->status=='0' ? 'selected' : ''}}>Drafted</option>

                     
                    </select>
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline:</label>
                    <input value="{{$job->deadline}}" type="date" name="deadline" class="form-control">
                </div>
                <div class="form-group">
                        <button type="submit" class="btn btn-block btn-outline-success"> Update job </button>
                </div>

                </div>
              </form>
                </div>
            </div>
     
 

    </div>
</div>
@endsection
