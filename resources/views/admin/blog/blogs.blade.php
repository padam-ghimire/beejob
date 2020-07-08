


  {{-- resources/views/admin/dashboard.blade.php --}}

  @extends('adminlte::page')

  @section('title', 'Dashboard')
  
  @section('content_header')
      <h1>Dashboard</h1>
     
  @stop
  
  @section('content')
      <p>All Blogs</p>
      @if (Session::has('message'))
      <div class="alert alert-success">
          {{Session::get('message')}}
      </div>
       @endif
  @if($blogs->count()!=0)
      <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Content</th>
              <th scope="col">Image</th>
              <th scope="col">status</th>
              <th scope="col">Create date</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($blogs as $blog)
              <tr>
              <td>{{$blog->title}}</td>
                <td>{{str_limit($blog->content,30)}}</td>
              <td><img src="{{asset('storage/'.$blog->image)}}" width="75"></td>
              <td>
                  @if ($blog->status==0)
              <a href="{{route('change.status',$blog->id)}}" class="badge badge-primary">Pending</a>   
                  @endif
                  @if ($blog->status==1)
                  <a href="{{route('change.status',$blog->id)}}" class="badge badge-success">Live</a>   
 
                  @endif
                
                
                </td>
              <td>{{$blog->created_at->diffForHumans()}}</td>
              <td>
              <a href="{{route('blog.edit',$blog->id)}}"><button class="btn btn-success">Edit</button></a> 
                  {{-- <button class="btn btn-danger">Delete</button> --}}

                  <!-- Button trigger modal -->
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$blog->id}}">
    Delete
  </button>
  
  <!-- Modal -->
<div class="modal fade" id="exampleModal{{$blog->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure to  delete?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       
    <form action="{{route('blog.delete')}}" method="post">
            @csrf
            <div class="modal-footer">
            <input type="text" name="id" value="{{$blog->id}}">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>

        </form>
      </div>
    </div>
  </div>
                </td>
              </tr>
              
                  
              @endforeach
          </tbody>
        </table>
        {{$blogs->links()}}
        
      @else
        <p>No blogs till now</p>
      @endif
        
  @stop
  
  @section('css')
      <link rel="stylesheet" href="/css/admin_custom.css">
  @stop
  
  
  
  
  