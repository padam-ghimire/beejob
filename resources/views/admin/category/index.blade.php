


  {{-- resources/views/admin/dashboard.blade.php --}}

  @extends('adminlte::page')

  @section('title', 'Dashboard')
  
  @section('content_header')
      <h1>Dashboard</h1>
     
  @stop
  
  @section('content')
      <p>All Categories</p>
      @if (Session::has('message'))
      <div class="alert alert-success">
          {{Session::get('message')}}
      </div>
       @endif
  @if($categories)
      <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Name</th>
              
              <th scope="col">created at</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($categories as $category)
              <tr>
             
                <td>{{$category->name}}</td>
             
              <td>{{$category->created_at->diffForHumans()}}</td>
              <td>
              <a href="{{route('category.edit',$category->id)}}"><button class="btn btn-success">Edit</button></a> 
                  {{-- <button class="btn btn-danger">Delete</button> --}}

                  <!-- Button trigger modal -->
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$category->id}}">
    Delete
  </button>
  
  <!-- Modal -->
<div class="modal fade" id="exampleModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure to  delete?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       
    <form action="{{route('category.delete',$category->id)}}" method="post">
            @csrf
            <div class="modal-footer">
            <input type="text" name="id" value="{{$category->id}}">
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
        {{$categories->links()}}
        
      @else
        <p>No categories till now</p>
      @endif
        
  @stop
  
  @section('css')
      <link rel="stylesheet" href="/css/admin_custom.css">
  @stop
  
  
  
  
  