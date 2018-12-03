<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Account | {{env('APP_NAME', 'The Crete Trip')}}</title>
    <link rel="icon" href="{{route('home')}}/favicon.ico" type="image/x-icon"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{route('lc.home')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>TCT</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>The Crete Trip {{\Carbon\Carbon::now()->year}}</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MENU</li>
                <li><a href="{{route('participants.terms')}}"><i class="fa fa-gavel"></i>
                        <span>Terms & Conditions</span></a></li>
                <li><a href="{{route('participants.faq')}}"><i class="fa fa-question-circle"></i> <span>FAQ</span></a>
                </li>
                @if(Auth::user()->section === "International Guests (ESNers)")
                    <li><a href="{{route('participants.pay')}}"><i class="fa fa-money"></i>
                            <span>Fee Payment</span></a></li>
                @endif
                <?php $rooming = DB::table('event')->where("attribute", "rooming")->first()->value;?>
                @if(Auth::user()->fee != "No" && $rooming === "1" )
                    <li><a href="{{route('participants.rooming')}}"><i class="fa fa-home"></i>
                            <span>Rooming</span></a></li>
                @endif
                <?php $lcs = DB::table('users')->where('section', Auth::user()->section)->where('role_id', 2)->get()?>
                <li class="treeview">
                    <a href="#"><i class="fa fa-address-book"></i> <span>ESN responsible</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        @foreach($lcs as $lc)
                            <li><a target="_blank" href="{{$lc->facebook}}"><i
                                            class="fa fa-facebook-square"></i>
                                    <span></span>{{$lc->name.' '.$lc->surname}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{route('participants.logout')}}"><i class="fa fa-power-off"></i> <span>Logout</span></a>
                </li>
                @if(Auth::user()->role_id == 2)
                    <li><a href="{{route('lc.home')}}"><i class="fa fa-backward"></i> <span>Back to LC Panel</span></a></li>
                @endif
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Built by <a href="https://www.linkedin.com/in/frangiadakisdimitris/">Dimitris Frangiadakis</a> of <a
                    href="https://www.facebook.com/esnharo/">ESN Haro</a>.
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{\Carbon\Carbon::now()->year}} <a href="#">The Crete Trip</a>.</strong> All rights
        reserved.
    </footer>
</div>

<script src="{{asset('js/app.js')}}"></script>
@yield('js')
</body>
</html>