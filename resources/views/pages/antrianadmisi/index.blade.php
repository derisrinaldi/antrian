<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template · Bootstrap v5.0</title>


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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

        .user-avatar {
            max-width: 230px;
            width: 100%;
            border: 3px solid #fff;
        }

        .img-circle {
            border-radius: 50%;
        }

        .my-btn {
            padding-top: 15px;
            padding-bottom: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: 10px 10px 5px 0 rgba(0, 0, 0, .75);
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
</head>

<body>
    <div class="ui-base">
        <div class="login-page">
            <div class="img-container">
                <div class="text-center pull-right photo">
                    <img src="{{ asset('images/avatar.png') }}"
                        class="user-avatar img-circle img-responsive float-end">

                </div>
            </div>
            <div class="form-content">
                <h1>PESERTA BARU / ADMISI</h1>
                <h5 style="margin-top:10px;margin-bottom:10px;font-size:14px;">Silahkan ambil nomor antrian dibawah</h5>
                <button onclick="ant()"
                    class="block card bg-warning my-btn text-decoration-none text-center text-white">

                    <i class="bi bi-chevron-down"></i>
                    <span class="text-info font-thin h1 block" style="font-weight:bold">Klik Disini</span>
                    <i class="bi bi-chevron-up"></i>


                </button>
            </div>
        </div>
    </div>

    {{-- <main class="form-signin">
        <div class="row mt-5">
            <div class="col-lg-5 position-relative" style="vertical-align: middle">
                <img class="mb-4 position-absolute end-0 img-circle img-responsive user-avatar"
                    src="https://antrean.bpjs-kesehatan.go.id/antrean-rs/libs/assets/images/male.png" alt="">
            </div>
            <div class="col-lg-7 top-50">

                <form>

                    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                    <div class="form-floating">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
                </form>
            </div>
        </div>
    </main> --}}
    <iframe id='print-iframe' name='printf'></iframe>

    {{-- Bootrap core js --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function ant() {
            $.ajax({
                type: "GET",
                url: "/antrian/1",
                dataType: 'json',
                success: function(response) {
                   
                    var newWin = window.frames["printf"];
                    newWin.document.body.innerHTML = '';
                    newWin.document.write(
                        '<center>' +
                        '<h4>RS PERMATA KUNIGAN</h4>' +
                        '<p style="font-size: 12px">' + response.date + '</p>' +
                        '<span style="display: inline-block;width: 20%;border-top: 2px solid black;"></span>' +
                        '<h1 style="font-size: 46px">' + response.antrian + '</h1>' +
                        '<h6>' + response.unit + '</h6>' +
                        '<span style="display: inline-block;width: 20%;border-top: 2px solid black;"></span>' +
                        '<p>Sisa Antrean : ' + response.rest + '</p>' +
                        '<p style="font-size: 8px">*) Silahkan mengambil nomor antrian baru,<br>jika nomor antrian terlewatkan</p>' +
                        '</center>'
                    );
                    newWin.focus();
                    newWin.print();
                    Swal.fire({
                        title: response.antrian,
                        icon: 'success',
                        timer:500
                    })
                }
            })
        }
    </script>
</body>

</html>
