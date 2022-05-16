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
            {{--            <img src="{{ asset('../dist/img/AdminLTELogo.png') }}" alt="userLogo"
                             class="brand-image img-circle elevation-3"
                             style="opacity: .8">--}}
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
                    </a>
                </div>
            </div>

            <!-- SidebarSearch Form -->


            <!-- Sidebar Menu -->
            <nav class="mt-2 nav-flat nav-child-indent">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="true">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->


                    {{--NEW--}}
                        <li id="bob" class="nav-header d-flex justify-content-between align-items-start nav-link">
                            <p>МОИ ПРОЕКТЫ</p>
                            <a id="addButton" class="btn btn-success btn-xs mr-2" href="{{ route ('project.create') }}" title="Добавить новый проект">+</a>
                        </li>

                    @if (isset($projectsMenuItems))
                        @foreach ($projectsMenuItems as $projectsMenuItem)
                            <li id="{{ $projectsMenuItem->id}}" class="nav-item {{--menu-is-opening menu-open--}}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa fa-folder" style="color: #d2691b;"></i>
                                    <p>
                                        {{ $projectsMenuItem->name }}
                                        {{--     {{ $projectsMenuItem->id }}--}}
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" {{--style="display: none;"--}}>
                                    <li class="nav-item">
                                        @if (isset($chaptersMenuItems))
                                            @foreach($chaptersMenuItems as $chaptersMenuItem)
                                                @if($chaptersMenuItem->project_id == $projectsMenuItem->id)
                                                    <a id={{ $chaptersMenuItem->id}} href="{{ route('chapter.show', [$chaptersMenuItem->id]) }}"
                                                       class="nav-link">
                                                        <i class="fa fa-file nav-icon pb-1" style="font-size: 85%;"></i>
                                                        <p>{{ $chaptersMenuItem->name }}</p>
                                                    </a>
                                                @endif
                                            @endforeach
                                        @endif

                                        <a href="{{ route('chapter.create', ['project' => $projectsMenuItem->id]) }}"
                                           title="Добавить раздел"
                                           class="nav-link ml-2 text-muted" style="font-size: 85%;">
                                            <i class="fa fa-plus-circle nav-icon" style="font-size: 85%;"></i>
                                            <p>Добавить парсер</p>
                                        </a>

                                        {{--TODO При добавлении парсера необходимо переходить к этому меню (видимо, ридеректом проще)--}}

                                        <a href="{{ route('project.edit', $projectsMenuItem->id) }}"
                                           title="Изменить проект"
                                           class="nav-link ml-2 text-muted" style="font-size: 85%;">
                                            <i class="fa fa-edit nav-icon" style="font-size: 85%;"></i>
                                            <p>Изменить проект</p>
                                        </a>

                                        <hr class="m-2" style="border-top: 1px solid #5e5e5e;">


                                    </li>
                                </ul>
                            </li>
                        @endforeach
                    @endif


                    {{--END OF NEW--}}


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

<script type="text/javascript">
    let ProjectMenuTabIdKey = {{ Session::get('ProjectMenuTabIdKey') }};
    let projectItem = document.getElementById(ProjectMenuTabIdKey);

    let ChapterMenuTabIdKey = {{ Session::get('ChapterMenuTabIdKey') }};
    let chapterItem = document.getElementById(ChapterMenuTabIdKey);

    projectItem.classList.add("menu-open");
    chapterItem.classList.add("active");

</script>

<!-- OPTIONAL SCRIPTS -->
{{--<script src="../plugins/chart.js/Chart.min.js"></script>--}}
<!-- AdminLTE for demo purposes -->
{{--<script src="../dist/js/demo.js"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="../dist/js/pages/dashboard3.js"></script>--}}


</body>
</html>
