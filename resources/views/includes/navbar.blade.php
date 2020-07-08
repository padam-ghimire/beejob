<div class="site-wrap">

  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div> <!-- .site-mobile-menu -->
  
  
  <div class="site-navbar-wrap js-site-navbar bg-white">
    
    <div class="container">
      <div class="site-navbar bg-light">
        <div class="py-1">
          <div class="row align-items-center">
            <div class="col-2">
              {{-- <h2 class="mb-0 site-logo"><a href="/">Bee<strong class="font-weight-bold">Job</strong> </a></h2> --}}
              <a href="/"><img src="{{ asset('avatar/main.png')}}" class="" height="50" alt=""> | BEE JOB</a>

            </div>
            <div class="col-10">
              <nav class="site-navigation text-right" role="navigation">
                <div class="container">
                  <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>
                  <ul class="site-menu js-clone-nav d-none d-lg-block">
                  @if(!Auth::check())

                  <li><a  class="btn btn-outline-success" href="{{ route('register')}}">For Seeker</a></li>
                    <li class="has-children">
                      <a class="btn btn-outline-success" href="{{ route('company.register')}}">For Employees</a>
                     
                    </li>
                  <li>
                    <a class="btn btn-outline-info" href="{{ route('login')}}">Login </a></li>

                    <li></li>
                    @endif
                      @if(Auth::check() && Auth()->user()->user_type=='company')
                  <li><a href="{{ route('job.create')}}"><span class="bg-primary text-white py-3 px-4 rounded"><span class="icon-plus mr-3"></span>Post New Job</span></a>
                    <li><a href="{{ route('home')}}"><span class="bg-primary text-white py-3 px-4 rounded"><span class=" mr-3"></span>Home<span></a>
                      {{-- <li><a href="{{ route('logout')}}"><span class="bg-primary text-white py-3 px-4 rounded"><span class=" mr-3"></span>log out<span></a> --}}

                    </li>
                      @endif

                      @if(Auth::check() && Auth()->user()->user_type=='seeker')
                        <li><a href="{{ route('seeker.profile')}}"><span class="bg-primary text-white py-3 px-4 rounded">Profile</a></li>
                          {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                           <li> <button class="btn btn-danger" type="submit"><span class="bg-primary text-white py-3 px-4 rounded"> Logout</button>
                           </li>
                        </form> --}}
                          {{-- <li><a href="{{ route('logout')}}"><span class="bg-primary text-white py-3 px-4 rounded"><span class=" mr-3"></span>log out<span></a> --}}
    
                         
                          @endif
                      
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div style="height: 113px;"></div>
