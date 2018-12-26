<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Courses Academy') }}</title>
    <!-- Styles -->
    <link href="{{asset('assets/css/core.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/thesaas.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
</head>
<body>
    <div id="app">
            <!-- Topbar -->
            <nav class="topbar topbar-inverse topbar-expand-md topbar-sticky">
                <div class="container">

                    <div class="topbar-left">
                        <button class="topbar-toggler">&#9776;</button>
                        <a class="topbar-brand" href="{{url('/')}}">
                            <img class="logo-default" src="{{asset('assets/img/logo.png')}}" alt="logo">
                            <img class="logo-inverse" src="{{asset('assets/img/logo-light.png')}}" alt="logo">
                        </a>
                    </div>


                    <div class="topbar-right">
                        <ul class="topbar-nav nav">
                            <li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('/admin/series/')}}">All Series</a></li>

                            @if (Auth::guest())
                                <li class="nav-item"><a class="nav-link" href="javascript:;" data-toggle="modal" data-target="#loginModal">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="#" class="nav-link">
                                        {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                                    </a>

                                    <div class="nav-submenu">
                                            <a class="nav-link" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>

                </div>
            </nav>
            <!-- END Topbar -->
            @yield('header')
            @yield('content')
            @if (Auth::guest())
                <login-vue></login-vue>
            @endif
        <vue-noty></vue-noty>
    </div>
    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row gap-y align-items-center">
                <div class="col-12 col-lg-3">
                    <p class="text-center text-lg-left">
                        <a href="{{url('/')}}"><img src="{{asset('assets/img/logo.png')}}" alt="logo"></a>
                    </p>
                </div>

                <div class="col-12 col-lg-6">
                    <ul class="nav nav-primary nav-hero">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Home</a>
                        </li>

                    </ul>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="social text-center text-lg-right">
                        <a class="social-facebook" href="https://www.facebook.com/thethemeio"><i class="fa fa-facebook"></i></a>
                        <a class="social-twitter" href="https://twitter.com/thethemeio"><i class="fa fa-twitter"></i></a>
                        <a class="social-instagram" href="https://www.instagram.com/thethemeio/"><i class="fa fa-instagram"></i></a>
                        <a class="social-dribbble" href="https://dribbble.com/thethemeio"><i class="fa fa-dribbble"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->



    <!-- Scripts -->
    <script src="{{asset('assets/js/core.min.js')}}"></script>
    <script src="{{asset('assets/js/thesaas.min.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
