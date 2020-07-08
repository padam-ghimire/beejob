


  {{-- resources/views/admin/dashboard.blade.php --}}

  @extends('adminlte::page')

  @section('title', 'Dashboard')
  
  @section('content_header')
      <h1>Dashboard</h1>
     
  @stop
  
  @section('content')
      <p> Recycle bin</p>
      @if (Session::has('message'))
      <div class="alert alert-success">
          {{Session::get('message')}}
      </div>
       @endif
  
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
                   <a href="" class="badge badge-primary">Pending</a>   
                  @endif
                  @if ($blog->status==1)
                  <a href="" class="badge badge-success">Live</a>   
 
                  @endif
                
                
                </td>
              <td>{{$blog->created_at->diffForHumans()}}</td>
              <td>
              <a href="{{route('blog.restore',$blog->id)}}"><button class="btn btn-success">Restore</button></a> 
                 
  

                </td>
              </tr>
              
                  
              @endforeach
          </tbody>
        </table>
        {{$blogs->links()}}
        
      
        
  @stop
  
  @section('css')
      <link rel="stylesheet" href="/css/admin_custom.css">
  @stop
  
  
  
  
  