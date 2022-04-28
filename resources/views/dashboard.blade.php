<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 5 Simple Admin Dashboard</title>
    <!-- insert stylesheets here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
          integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>

@include('includes.header')

<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <!-- sidebar content goes in here -->
            @include('includes.sidebar')
        </nav>

        <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
            @include('includes.breadcrumb')



            <div id="content">
                <h1 class="h2">Dashboard</h1>
                <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A culpa cumque dolor neque sit. Amet
                    doloribus eaque eum fugit itaque minima nam natus nemo odio, quod reiciendis rerum sunt velit!
                </div>
                <div>Ab assumenda eaque minus nesciunt porro quidem sapiente tempore. Amet, aperiam deserunt error
                    excepturi, expedita fugiat iste itaque maiores, natus officia porro quas repellat sunt suscipit
                    tenetur unde voluptas voluptatibus.
                </div>
                <div>Animi at doloribus dolorum eligendi enim impedit iure, laudantium quae rem? Ad aut, culpa
                    dignissimos dolore eius error est ex in minus odio odit quas quo suscipit totam, ullam voluptas.
                </div>
                @yield('content')

            </div>

            {{--@include('includes.footer')--}}

        </main>

    </div>
</div>


<!-- insert scripts here -->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
        crossorigin="anonymous"></script>

<style>

    #content {
        min-height: 70vh;
    }

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 90px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        z-index: 99;
    }

    @media (max-width: 767.98px) {
        .sidebar {
            top: 11.5rem;
            padding: 0;
        }
    }

    .navbar {
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
    }

    @media (min-width: 767.98px) {
        .navbar {
            top: 0;
            position: sticky;
            z-index: 999;
        }
    }

    .sidebar .nav-link {
        color: #333;
    }

    .sidebar .nav-link.active {
        color: #0d6efd;
    }


</style>

</body>
</html>

