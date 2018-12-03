<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LC/GL | {{env('APP_NAME', 'The Crete Trip')}}</title>
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
                <!-- Optionally, you can add icons to the links -->
                <li><a href="{{ route('lc.home') }}"><i class="fa fa-users"></i> <span>My registrations</span></a></li>
                <li><a href="@yield('route')"><i class="fa fa-user-circle-o"></i> <span>Switch type</span></a></li>
                <li><a href="{{route('lc.statistics')}}"><i class="fa fa-bar-chart"></i> <span>Statistics</span></a>
                </li>
                <?php $rooming = DB::table('event')->where("attribute", "rooming")->first()->value;?>
                @if(Auth::user()->fee != "No" && Auth::user()->section != "ESN UOC - HERAKLION" &&  Auth::user()->section != "ESN TEI OF CRETE" && $rooming === "1" )
                    <li><a href="{{route('participants.rooming')}}"><i class="fa fa-home"></i>
                            <span>Rooming</span></a></li>
                @endif
                <li class="treeview">
                    <a href="#"><i class="fa fa-ship"></i> <span>Manage Boats</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('lc.boatToCrete')}}"><i class="fa fa fa-ship"></i> <span>To Crete</span></a></li>
                        <li><a href="{{route('lc.boatFromCrete')}}"><i class="fa fa fa-ship"></i> <span>From Crete</span></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-money"></i> <span>Payments</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('lc.bank')}}"><i class="fa fa-bank"></i> <span>Bank Details</span></a></li>
                        <li><a href="{{route('lc.uploadProof')}}"><i class="fa fa-file-text"></i> <span>Upload Proof of Payment</span></a></li>
                        <li><a href="{{route('lc.myPayments')}}"><i class="fa fa-list-ul"></i> <span>My payments</span></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-address-book"></i> <span>Contact</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a target="_blank" href="https://m.me/mikropoulos"><i class="fa fa-facebook-square"></i>
                                <span>Sections' Coordinator</span></a></li>
                        <li><a target="_blank" href="https://m.me/frangiadakis.dimitris"><i
                                        class="fa fa-facebook-square"></i> <span></span>IT Manager</a></li>
                    </ul>
                </li>
                <li><a href="{{route('lc.logout')}}"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
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
            @yield('style')
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