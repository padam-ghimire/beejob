@extends('layouts.app')


@section('content')
<div class="container">
   
    <div class="row">
        
       <div class="col-md-3">

            <div class="row">
                <div class="col-md-5  border-right">
                    @if (empty(Auth()->user()->company->logo))
                    <img class="float-left" src="{{asset('avatar/main.png')}}"  alt="profile Image" width="100" >
                    @else  
                    <img  class=" rounded-circle img-fluid" id="photo"  src="{{asset('uploads/company_logo')}}/{{Auth()->user()->company->logo}}" alt="" srcset="">
                    @endif

                    
                </div>
                <div class="col-md-7" >
                    {{Auth()->user()->company->company_name}}
                    <br>

                    <font size="1" style="color:#55a1e1;">
                        @if (Auth()->user()->company->slogan)
                        "{{Auth()->user()->company->slogan}}"<br>
                        @endif
                        
                        Since:&nbsp;{{Auth()->user()->created_at->diffForHumans()}}<br>
                        @if (Auth()->user()->company->address)
                        <i class="fa fa-address-book">&nbsp; {{Auth()->user()->company->address}}</i>  <br>
                        @endif
                        @if (Auth()->user()->company->phone)
                        <i class="fa fa-phone">&nbsp; {{Auth()->user()->company->phone}}</i>  <br>
                        @endif
                        <i class="fa fa-envelope">&nbsp; {{Auth()->user()->email}} </i> 
                        @if (Auth()->user()->company->website)
                        <a href="{{Auth()->user()->company->website}}"><i class="fa fa-globe" >&nbsp; {{Auth()->user()->company->website}}</i></a>  <br>
                        @endif
                    </font>
                    {{-- <p>Hello My name is Padam Ghimire</p> --}}
                </div>
            </div>
            <hr>
            @if ($errors->has('company_logo'))
            <div class="alert alert-danger">
              
                    {{ $errors->first() }}<br>
               
            </div>
        @endif
           <form action="{{ route('logo.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <label for="company_logo">Update Company logo</label>
                <input id='logo' type="file" class="" onchange="loadPhoto(event);" name="company_logo" > 
                <button class="btn btn-outline-success btn-block mt-2" type="submit">Update</button>
            </div>
            </form>
            <hr>
          
       </div>
       <div class="col-md-5">
        @if (Session::has('msg'))
        <div class="alert alert-success">
            {{Session::get('msg')}}
        </div>
         @endif
            <div class="card">
                <div class="card-header">
                    Update your Company Details
                </div>
                <form action=" {{route('company.update') }}" method="post">
                    
                    @csrf
                <div class="card-body"> 
                   <div class="form-group">
                       <label for="address">Address</label>
                       <input type="text" class="form-control" name="company_address" value="{{Auth()->user()->company->address}}">
                   </div>
                   <div class="form-group">
                       <label for="experince">Website</label>
                       <input type="text" class="form-control" name="company_website"value="{{Auth()->user()->company->website}}">
                   </div> 
                   <div class="form-group">
                       <label for="experince">Phone</label>
                       <input type="text" class="form-control" name="company_phone" value="{{Auth()->user()->company->phone}}">
                   </div> 
                   <div class="form-group">
                       <label for="experince">Slogan</label>
                       <input type="text" class="form-control" name="company_slogan" value="{{Auth()->user()->company->slogan}}">
                   </div> 
                  
                   <div class="form-group">
                       <label for="experince">Description</label>
                       <textarea class="form-control" name="company_description">{{Auth()->user()->company->description}}</textarea>
                   </div> 
                   <div class="form-group">
                       <button type="submit" class="btn btn-outline-success  float-right">Update </button>
                   </div> 
                </div>
                </form>
            </div>
       </div>
       <div class="col-md-4" >
            <div class="card">
                <div class="card-header">

                    Cover Image <span class="danger">Cover must be 720/200 </span>
                    @if(Auth()->user()->company->display_picture)

                    <div>
                    <img  class="img-fluid" id="cover"  src="{{asset('uploads/cover_image')}}/{{Auth()->user()->company->display_picture}}" alt="Cover image" onclick="Cover(event);">
                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                        <span class="close">&times;</span>
                        <img class="modal-content img-fluid" id="img01">
                        <div id="caption"></div>
                    </div>
                    </div>

                    @endif

                    @if ($errors->has('cover_image'))
                <div class="alert alert-danger">
                        {{ $errors->first() }}<br>
                </div>
            @endif
                </div>
               <form action="{{ route('cover_image.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
    
                    <div class="upload-btn-wrapper">
                        <button class="uploadbtn">Upload Cover Image</button>
                        <input type="file" onchange="loadCover(event);" name="cover_image" />
                      </div>
                        <button class="btn btn-outline-success btn-block mt-2 " type="submit">Update</button>
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

    function loadCover(event){
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('cover');
            output.src= reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

function Cover(event){
    console.log("Clicked")
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("cover");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
}
</script>

@endsection
