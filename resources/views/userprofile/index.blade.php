@extends('layouts.app')


@section('content')
<div class="container">
   
    <div class="row">
        
       <div class="col-md-3">

            <div class="row">
                <div class="col-md-5 border-right">
                    @if (empty(Auth()->user()->profile->avatar))
                    <img src="{{asset('avatar/main.png')}}"  alt="profile Image" width="100" >
                    @else  
                     <img id="photo" class="rounded-circle img-fluid" src="{{asset('uploads/profile_image')}}/{{Auth()->user()->profile->avatar}}" alt="profile Image"  >
                    @endif

                </div>
                <div class="col-md-7 " >
                    {{Auth()->user()->name}}<br>
                    <font size="1"> Since:&nbsp;{{Auth()->user()->created_at->diffForHumans()}}<br>
                        <i class="fa fa-venus-mars">&nbsp; {{Auth()->user()->profile->gender}}</i> <br>
                        @if (Auth()->user()->profile->address)
                        <i class="fa fa-address-book">&nbsp; {{Auth()->user()->profile->address}}</i>  <br>
                        
                        @endif
                        <i class="fa fa-envelope">&nbsp; {{Auth()->user()->email}} </i>
                        
                    </font>
                    {{-- <p>Hello My name is Padam Ghimire</p> --}}
                </div>
            </div>
            <hr>
            @if ($errors->has('pp'))
            <div class="alert alert-danger">
              
                    {{ $errors->first() }}<br>
               
            </div>
        @endif
           <form action="{{ route('pp.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <label for="avatar">Update profile picture</label>
                <input type="file" class="" name="pp" onchange="loadPhoto(event);" > 
                <button class="btn btn-outline-success btn-block mt-2" type="submit">Update</button>
            </div>
            </form>
            <hr><hr>
           @if(!empty(Auth()->user()->profile->cover_letter))
            <a class="btn btn-outline-info  btn-block" href="{{Storage::url(Auth()->user()->profile->cover_letter)}}" download>Download cover letter</a>
           @else
           <h5>No cover letter uploaded</h5>
           @endif
           <hr>
           @if(!empty(Auth()->user()->profile->resume))
            <a class="btn btn-outline-success btn-block" href="{{Storage::url(Auth()->user()->profile->resume)}}" download>Download Resume</a>
           @else
           <h5>No  Resume uploaded</h5>
           @endif
       </div>
       <div class="col-md-5">
        @if (Session::has('msg'))
        <div class="alert alert-success">
            {{Session::get('msg')}}
        </div>
         @endif
            <div class="card">
                <div class="card-header">
                    Update your profile
                </div>
                <form action="{{ route('profile.update') }}" method="post">
                    
                    @csrf
                <div class="card-body"> 
                   <div class="form-group">
                       <label for="address">Address</label>
                       <input type="text" class="form-control" name="address" value="{{Auth()->user()->profile->address}}">
                   </div>
                   <hr>
                   <div class="form-group">
                       <label for="experince">Experience</label>
                       <textarea class="form-control" name="experience" >{{Auth()->user()->profile->experience}} </textarea>
                   </div> 
                    <hr>
                   <div class="form-group">
                       <label for="experince">Bio</label>
                       <textarea class="form-control" name="bio"> {{Auth()->user()->profile->bio}}</textarea>
                   </div> 
                   <div class="form-group">
                       <button type="submit" class="btn btn-outline-success  float-right">Update </button>
                   </div> 
                </div>
                </form>
            </div>
       </div>
       <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Other Details
            </div>
            <div class="card-body">
                
                
                Experinece: {{Auth()->user()->profile->experience}}<br>
                <hr>
                Bio: {{Auth()->user()->profile->bio}}<br>
            </div>
        </div>
            <div class="card">
            <div class="card-header">
                Cover Letter
                @if ($errors->has('cover_letter'))
            <div class="alert alert-danger">
                    {{ $errors->first() }}<br>
            </div>
        @endif
            </div>
           <form action="{{ route('cover.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

                <div class="upload-btn-wrapper">
                    <button class="uploadbtn">Upload Cover Letter</button>
                    <input type="file" name="cover_letter" />
                  </div>

               
                <button class="btn btn-outline-success btn-block mt-2" type="submit">Update</button>
            </div>
        </form>
        </div>
        <div class="card">
            <div class="card-header">
               Resume
               @if ($errors->has('resume'))
               <div class="alert alert-danger">
                   
                       {{ $errors->first() }}<br>
               
               </div>
             @endif
            </div>
           <form action="{{ route('resume.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <input type="file"  class="" name="resume" > 
                <button class="btn btn-outline-success btn-block mt-2" type="submit">Update</button>
            </div>
           </form>
        </div>
       </div>
    </div>
</div>
<div class="card float-right">
<div class="card-header">
    <a class="btn btn-danger"  href="{{ route('account.reset')}}" onclick="return confirm('are you sure to reset your profile?')">Reset your profile</a>
</div>
</div>
<script>
    function loadPhoto(event){
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('photo');
            output.src= reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
