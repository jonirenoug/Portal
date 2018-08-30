<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title> Neighbour Portal | Neighbourhood Work </title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">
    
</head>
<body class="showpopup onchange @if(!Session::has('userlogin'))not-login @else logged @endif">
    <header>
        <div class="col-sm-12">
            <div class="box-logo col-sm-4">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('images/newlogo.png') }}">
                </a>
                <div class="btnMenu pull-right">
                    <a href="javascript:;" class="hoverJS" style="opacity: 0.8;">
                        <i class="fa fa-bars" style=""></i>
                        <i class="fa fa-times" style="display: none;"></i>
                    </a>
                </div>
            </div>
            @if(Session::has('userlogin'))
            <div class="box-menu col-sm-8">
                <ul>
                    <li>
                        <a href="{{ url('room') }}">Room booking</a>
                        {{-- @include('common.submenu') --}}
                    </li>
                    <li><a href="{{ url('member-profile') }}">Profile</a></li>
                    <li class="last-li"><a href="{{ url('logout') }}">Logout</a></li>
                </ul>
            </div>
            @endif
        </div>
    </header>
    <main>
        
        @yield('content')

    </main>  
    <footer>
        <div class="col-sm-12">
            <div class="copy_right"> &copy 2017-2019 Neighbourhood Work Pty.Ltd.All rights reserved <br> ABN: 52 621 871 403</div> 
        </div> 
    </footer> 
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/dev.js?t=' . uniqid()) }}"></script>

    @stack('scripts-bottom')

</body>
</html>