<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Content Management System</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('/assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/assets/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('stylesheet')
    <style>
        .img-thumbnail{
            display: inline-block;
            max-width: 100px;
            max-height: 100px;
        }
        .img-thumbnail img {
            width: 100%;
        }
    </style>
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

        </ul>


    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('/admin')}}" class="brand-link">

            <span class="brand-text font-weight-light">{{auth()->user()->name}}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item"><a class="nav-link" href="{{ url('/admin/setting') }}"><i class="far fa-circle nav-icon"></i> Setting</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/admin/usergroup') }}"><i class="far fa-circle nav-icon"></i> User Groups</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/admin/user') }}"><i class="far fa-circle nav-icon"></i> Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/admin/language') }}"><i class="far fa-circle nav-icon"></i> Language</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/admin/layout') }}"><i class="far fa-circle nav-icon"></i> Layout</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('/admin/menu')}}" class="nav-link">
                            <i class="nav-icon fa fa-th"></i>
                            <p>Menu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/admin/article')}}" class="nav-link">
                            <i class="nav-icon fa fa-newspaper"></i>
                            <p>Article</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/admin/advertise')}}" class="nav-link">
                            <i class="nav-icon fas fa-ad"></i>
                            <p>Advertise</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/admin/modules')}}" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Modules</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('/logout')}}" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('heading')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrubm')
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if (Session::has('alert-danger') || Session::has('alert-success'))
                    <div class="row">
                        <div class="col-md-12">
                            @if (Session::has('alert-danger'))
                                <div class="alert alert-danger">{{ Session::get('alert-danger') }}</div>
                            @endif
                            @if (Session::has('alert-success'))
                                <div class="alert alert-success">{{ Session::get('alert-success') }}</div>
                            @endif

                        </div>

                    </div>
                @endif

            <!-- Default box -->
                @yield('content')
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <footer class="main-footer">

        <!-- Default to the left -->
        <strong>Copyright &copy; {{date('Y')}}</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/assets/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/dist/js/demo.js')}}"></script>
@yield('javascript')
@yield('script')
</body>
</html>
