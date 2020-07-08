
    <div class="site-section block-15">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mx-auto text-center mb-5 section-heading">
            <h2>Recent Blog</h2>
          </div>
        </div>


        <div class="nonloop-block-15 owl-carousel">
          
          @foreach ($blogs as $blog)
              
          <div class="media-with-text">
            <div class="img-border-sm mb-4">
              <a href="#" class="image-play">
                <img src="{{asset('storage/'.$blog->image)}}" alt="" height="300" >
              </a>
            </div>
          <h2 class="heading mb-0 h5"><a href="#">{{$blog->title}}</a></h2>
          <span class="mb-3 d-block post-date">{{$blog->created_at->diffForHumans()}} By <a href="#">Admin</a></span>
          <a href="{{ route('blog.show',$blog->id)}}">
          <p>{{str_limit($blog->content,20)}}</p>
           </a>
          </div>
        
        
          @endforeach
          
            
         
          
         
           
          
           
        </div>

        <div class="row">
          
        </div>
      </div>
    </div>
    
