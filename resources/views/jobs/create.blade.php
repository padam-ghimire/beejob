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
            <div class="card">
                <div class="card-header">
                    Create New Job
                </div>
                 <form action=" {{ route('job.store')}}" method="post">
                    @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title:</label>
                    <input type="text" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                <div class="form-group">
                    <label for="title">Position:</label>
                    <input type="text" name="position" value="{{old('position')}}" class="form-control  @error('position') is-invalid @enderror">
                    @error('position')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                </div>

                <div class="form-group">
                    <label for="title">Vacancies:</label>
                    <input type="text" name="vacancies" value="{{old('vacancies')}}" class="form-control  @error('vacancies') is-invalid @enderror">
                    @error('vacancies')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                </div>

                <div class="form-group">
                    <label for="title">Salary:</label>
                    <input type="text" name="salary" value="{{old('salary')}}" class="form-control  @error('salary') is-invalid @enderror">
                    @error('salary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                </div>
        
                    <div class="form-group">
                        <label for="title">Address:</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}">
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                <div class="form-group">
                    <label for="title">Type:</label>
                    <select name="type" class="form-control @error('tyoe') is-invalid @enderror" id="">
                        <option value="full_time">Full Time</option>
                        <option value="part_time">Part Time</option>
                        <option value="freelancing">Freelancer</option>
                    </select>
                    @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                    <label for="catgory">Category:</label>
                    <select name="category" id="" class="form-control @error('category') is-invalid @enderror">
                        @foreach (App\Category::all() as $category)
                             <option value="{{ $category->id }}">{{$category->name}}</option>
                        @endforeach
        
                    </select>
                    @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                  <div class="form-group">
                         <label for="roles_responsibilities">Roles and responsibilties:</label>
                    <textarea class="form-control @error('roles_responsibilities') is-invalid @enderror" name="roles_responsibilities" id="roles_responsibilties">{{old('roles_responsibilities')}}</textarea>
                    @error('roles_responsibilities')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                    <label for="title">Description:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" >{{old('description')}}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>

                 <div class="form-group">
                    <label for="title">Experiences:</label>
                        <textarea class="form-control @error('experiences') is-invalid @enderror" name="experiences" id="experiences" >{{old('experiences')}}</textarea>
                        @error('experiences')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>

                 <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                        <option value="Open">Open</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                     @enderror
                </div>

                 <div class="form-group">
                    <label for="title">Status:</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="">
                        <option value="1">Open</option>
                        <option value="0">Draft</option>
                    </select>
                    @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                     @enderror
                </div>
                <div class="form-group">
                    <label for="title">Deadline:</label>
                    <input type="date" name="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{old('deadline')}}">
                    @error('deadline')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                        <button type="submit" class="btn btn-block btn-outline-success"> Create job </button>
                </div>

                </div>
              </form>
                </div>
            </div>
     
 

    </div>
</div>
@endsection
