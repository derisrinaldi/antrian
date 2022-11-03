<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        /* Show it is fixed to the top */
        body {
            min-height: 75rem;
            padding-top: 4.5rem;
        }

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

        .card {
            border-radius: 0px;
            /* box-shadow: 5px 5px 5px #888888; */
        }

        .card .card-header {
            background-color: #1abc9c;
            border-radius: 0px;
            color: white;
        }

        .btn {
            border-radius: 0px;
        }
    </style>
    @stack('style')
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light"
        style="z-index: 1025;box-shadow: 0px 0px 1px 0px #8a8a8a">
        <div class="container-fluid">
            <div class="col-lg-3">
                <img src="{{ asset('images/logo.png') }}" alt="" width="40" height="40">
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <h3 class="fw-bolder">Rumah Sakit Permata Kuningan</h3>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="text-end">
                    asdfa</div>
            </div>

        </div>
    </nav>

    <main class="container-fluid">
        @yield('container')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('script')

</body>

</html>
