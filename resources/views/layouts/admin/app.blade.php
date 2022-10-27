<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Antrian</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">



    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .navbar-brand {
            background-color: #1a9c39;
        }

        .bg-blue {
            background: #0033cc;
        }

        .card {
            border-radius: 1px;
            border-color: 1px solid #f8fafc;
        }

        .btn {
            border-radius: 1px;
        }

        #card {
            border-radius: 0px;
            border-color: #f8fafc;
        }

        #card #card-body {
            background: #f8fafc;
        }

        .btn-addon.btn-sm i {
            width: 30px;
            height: 30px;
            margin: -6px 10px -6px -10px;
            line-height: 30px
        }

        .btn.btn-sm {
            padding: 4px 10px 4px 0px;
        }

        .btn.btn-sm i {
            background-color: rgba(0, 0, 0, .1);
            padding: 6px 10px 6px 10px;
        }

        .dataTables_length, .dataTables_filter {
            display: none;
        }
        
    </style>

    @stack('style')
</head>

<body>

    @include('layouts.component.admin-header')

    <div class="container-fluid">
        <div class="row">

            @include('layouts.component.admin-sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="row mt-2">
                    <div class="col-lg-12">
                        <h2 class="p-1">{{ $title ?? '' }}</h2>
                        @yield('container')
                        
                    </div>
                </div>
            </main>
        </div>
    </div>


    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/dashboard.js') }}"></script>

    @stack('script')
</body>

</html>
