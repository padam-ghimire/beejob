@extends('layouts.main')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-12">

        
<div class="card border-1 bg-light">
  <center>  <img class="card-img-top mt-2" style="width: 330px; border-radius:2%" height="250" src="{{asset('storage/'.$blog->image)}}" alt=""></center>
    
    
    {{-- <img class="card-img-top" style="width: 100px;" height="100px" src="{{asset('uploads/company_logo')}}/{{$company->logo}}" alt=""> --}}
  </div>
  <br>
  <br>
  <br>
  <br>
  <span style="font-size: 20px;"><b><u>{{$blog->title}}</u> </b></span> by Admin | Date: {{$blog->created_at->diffForHumans()}}
  

    <p class="card-text ml-2"> {{$blog->content}}</p>
    <br>
    <br>
    <br>
    <br>
   

    </div>
    </div>
  </div>
</div>
   </div>
</div>




@endsection
