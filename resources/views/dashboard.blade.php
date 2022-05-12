<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Jet Panda</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('../plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('../dist/css/adminlte.min.css') }}">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Справка</a>
            </li>

            {{--<li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>--}}
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto d-flex align-content-center">
            <!-- Navbar Search -->
            <li class="nav-item">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->email }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <li><a class="dropdown-item" href="/telescope" target="_blank">Telescope</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Messages</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    {{ __('Log Out') }}
                                </a>
                            </form>

                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('../dist/img/AdminLTELogo.png') }}" alt="userLogo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Jet Panda</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset ('../dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route ('dashboard') }}" class="d-block">
                        {{ Auth::user()->name }}
                        ({{ Auth::user()->id }})
                    </a>
                </div>
            </div>

            <!-- SidebarSearch Form -->


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="true">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    {{--Jaga--}}


                    <li id="bob" class="nav-item">
                        <div href="#" class="nav-link bg-warning d-flex justify-content-between align-content-center">
                            <div>
                                <i class="nav-icon fa fa-bars fa-lg" style="padding-right: 8px;"></i>
                                <p>МОИ ПРОЕКТЫ</p>
                            </div>
                            <div>
                                <a id="addButton" href="{{ route('project.create') }}"
                                   class="btn btn-outline-dark btn-xs"
                                   title="Добавить проект" style="color: black;">
                                    +
                                </a>
                            </div>
                        </div>

                    </li>


                    @if (isset($projectsMenuItems))
                        @foreach ($projectsMenuItems as $projectsMenuItem)
                            <li id="{{ $projectsMenuItem->id}}"
                                class="nav-item {{--menu-open--}} tab-{{ $projectsMenuItem->id}}">

                                <a href="#" class="nav-link justify-content-between" style="font-size: 85%;">
                                    <p>
                                        <i class="fa fa-folder mr-2"></i>
                                        {{ $projectsMenuItem->name }}
                                        ({{ $projectsMenuItem->id }})
                                    </p>

                                    <i class="fas fa-angle-left right"></i>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item" style="font-size: 85%;">


                                        @if (isset($chaptersMenuItems))
                                            @foreach($chaptersMenuItems as $chaptersMenuItem)
                                                @if($chaptersMenuItem->project_id == $projectsMenuItem->id)
                                                    <a href="{{ route('chapter.show', [$chaptersMenuItem->id]) }}"
                                                       class="nav-link ml-2">
                                                        <p>: </i>{{ $chaptersMenuItem->name }}</p>
                                                        <p>: </i>{{ $chaptersMenuItem->id }}</p>
                                                        {{--<p></br>
                                                        id({{ $chaptersMenuItem->id }})
                                                        project_id({{ $chaptersMenuItem->project_id }})
                                                        user_id({{ $chaptersMenuItem->user_id }})
                                                        </p>--}}
                                                    </a>
                                                @endif
                                            @endforeach
                                        @endif


                                        <span class="nav-link ml-4 accent-green" style="font-size: 75%;">
                                                <span>
                                                    <a href="{{ route('chapter.create', ['project' => $projectsMenuItem->id]) }}"
                                                       title="Добавить раздел">
                                                        <i class="fa fa-plus mr-1"></i>
                                                        Добавить парсер</a>
                                                </span>
                                        </span>

                                        <span class="nav-link" style="font-size: 85%;">
                                                <span>
                                                    <a href="{{ route('project.edit', $projectsMenuItem->id) }}"
                                                       title="Изменить проект">
                                                        <i class="fa fa-plus mr-1"></i>
                                                        Изменить проект</a>
                                                </span>
                                        </span>


                                        {{--<a href="{{ route('chapter.create', ['project' => $name->id]) }}"
                                           class="btn btn-success btn-xs" title="Добавить раздел"><i
                                                class="fa fa-plus" aria-hidden="true"></i></a>--}}

                                        {{--<a href="{{ route('project.edit', $projectsMenuItem->id) }}"
                                           class="btn btn-primary btn-xs ml-2" title="Редактировать проект"><i
                                                class="fa fa-pencil-alt" aria-hidden="true"></i></a>--}}

                                        <form method="POST"
                                              action="{{ route('project.destroy', $projectsMenuItem->id) }}">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-danger btn-xs ml-2"
                                                    data-toggle="tooltip" title='Удалить'><i class="fa fa-trash"
                                                                                             aria-hidden="true"></i>
                                            </button>
                                        </form>


                                    </li>
                                </ul>
                            </li>
                        @endforeach
                    @endif


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    {{--<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard v3</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v3</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>--}}
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @yield('content')
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>&copy; 2022 <a href="/">Jetpanda.ru</a></strong>
        <div class="float-right d-none d-sm-inline-block">
            <b>Версия</b> 1.0.0
        </div>
    </footer>
</div>
<!-- ./wrapper -->


<style>
    #addButton {
        visibility: hidden;
    }

    #bob:hover #addButton {
        visibility: visible;
    }
</style>




<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('../plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('../plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('../dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
{{--<script src="../plugins/chart.js/Chart.min.js"></script>--}}
<!-- AdminLTE for demo purposes -->
{{--<script src="../dist/js/demo.js"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="../dist/js/pages/dashboard3.js"></script>--}}
</body>
</html>
