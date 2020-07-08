<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   {{-- <script id="gs-sdk" src='//www.buildquickbots.com/botwidget/v2/demo/static/js/sdk.js?v=2' key="dc977cf6-e75a-460c-b4e4-abb261931726" ></script> --}}

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                    <img src="{{ asset('avatar/main.png')}}" class="" height="50" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if ( Auth()->user()->user_type=='seeker')
                                    
                        <li>
                            <a  class="btn btn-primary" href="{{ route('job.create')}}">Profile</a>

                        </li>
                        @endif
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('company.register') }}">{{ __('Company registration') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Job Seeker Register') }}</a>
                                </li>
                            @endif
                        @else
                                @if (Auth::check() && Auth()->user()->user_type=='company')
                                    
                                <li>
                                    <a  class="btn btn-primary" href="{{ route('job.create')}}">Post job</a>

                                </li>
                                @endif

                               
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  
                                  
                                  @if(Auth()->user()->user_type=="company")
                                        {{Auth()->user()->company->company_name}}
                                    @else
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth()->user()->user_type=="company")
                                    <a class="dropdown-item" href="{{ route('company.profile') }}">
    
                                        {{ __('Company') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('company.jobs') }}">
    
                                        {{ __('My Jobs') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('applications') }}">
    
                                        {{ __('Application') }}
                                    </a>
                                    @elseif(Auth()->user()->user_type=="seeker")
                                   
                                    
                                    <a class="dropdown-item" href="{{ route('seeker.profile') }}">
    
                                        {{ __('Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('home') }}">
    
                                        {{ __('Wish list') }}
                                    </a>
                                    
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
          
        </main>
    </div>
</body>

</html>
