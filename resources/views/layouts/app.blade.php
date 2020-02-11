<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{ 'images/property1.png' }}" type="image/x-icon">

<!--     <title> Rent/buy properties in Abeokuata quickly and cheaply on propertypal </title> -->
<!--     <title>{{ config('app.name', 'Coppa') }}</title> -->
        <title>@yield('title')  Propertypal | Rent/buy properties in Abeokuata quickly and cheaply on propertypal</title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-free-5.4.2-web/css/all.min.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="background: #3B5998;">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                        <a class="navbar-head" href="{{ url('/') }}">
                            <img src="{{ '/images/property.png' }}" class="logo"> Propertypal
                        </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}" style="color: #fff;">Login</a></li>
                            <li><a href="{{ route('register') }}" style="color: #fff;">Register</a></li>
                            <li><a href="{{ url('/showRequests') }}" style="color: #fff;">Requests</a></li>
                            <li><a href="{{ url('/blog_titles') }}" style="color: #fff;">Blog</a></li>
                        @else
                            @if(Auth::guard('web')->check())
                            <a class="nav navbar-brand" href="{{ url('/home') }}" style="color: #fff;">
                                Home
                            </a>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre style="color: #fff;">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/profile') }}"><span class="fa fa-user"></span> Update Profile</a>
                                        <a href="{{ url('/upload') }}"><span class="fa fa-image"></span> Upload a Property</a>
                                        <a href="{{ url('/uploadWithoutPicture') }}"><span class="fa fa-upload "></span> Upload Property Without Picture</a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class="fa fa-eject"></span>
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @elseif(Auth::guard('admin')->check())
                                <a class="nav navbar-brand" href="{{ url('/admin') }}" style="color: #fff;">
                                    Home
                                </a>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre style="color: #fff;">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                         <li>
                                                @if($adminRank == 1)
                                                <a href="{{ url('/admin/create-admin') }}"><span class="glyphicon glyphicon-user"></span> Create Admin</a>
                                                <a href="{{ url('/admin/advert') }}"><span class="glyphicon glyphicon-volume-up"></span> Create Adverts</a>
                                                @elseif($adminRank == 2)
                                                <a href="{{ url('/admin/advert') }}"><span class="glyphicon glyphicon-volume-up"></span> Create Adverts</a>
                                                @else
                                                @endif
                                                <a href="{{ url('/admin/reviews') }}"><span class="glyphicon glyphicon-book"></span> Transaction Reviews</a>
                                                <a href="{{ url('/admin/transactions') }}"><span class="glyphicon glyphicon-check"></span> Successful Transactions</a>
                                                <a href="{{ url('/admin/blog') }}"><span class="glyphicon glyphicon-pencil"></span> Make Blogpost</a>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                <span class="glyphicon glyphicon-eject"></span>
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @else
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
</body>
</html>
