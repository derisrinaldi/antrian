<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>{{ env('APP_NAME') }}</title>


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
                    <img src="{{ asset('images/avatar.png') }}" class="user-avatar img-circle img-responsive float-end">
                </div>
            </div>
            <div class="form-content">
                <div class="mb-4">
                    <h1>PENDAFTARAN / {{ $unit->unit_name }}</h1>
                    <h5 style="margin-top:10px;margin-bottom:10px;font-size:14px;">Silahkan ambil nomor antrian dibawah
                    </h5>
                    <button onclick="ant('{{ $unit_id }}')"
                        class="block card bg-warning my-btn text-decoration-none text-center text-white">

                        <i class="bi bi-chevron-down"></i>
                        <span class="text-info font-thin h1 block" style="font-weight:bold">Klik Disini</span>
                        <i class="bi bi-chevron-up"></i>
                    </button>
                </div>
                @if(isset($unit2))
                <div class="mb-4">
                    <h1>PENDAFTARAN / {{ $unit2->unit_name }}</h1>
                    <h5 style="margin-top:10px;margin-bottom:10px;font-size:14px;">Silahkan ambil nomor antrian dibawah
                    </h5>
                    <button onclick="ant('{{ $unit_id2 }}')"
                        class="block card bg-success my-btn text-decoration-none text-center text-white">

                        <i class="bi bi-chevron-down"></i>
                        <span class="text-white font-thin h1 block" style="font-weight:bold">Klik Disini</span>
                        <i class="bi bi-chevron-up"></i>
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>

    <iframe id='print-iframe' name='printf'></iframe>

    {{-- Bootrap core js --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function ant(unit_id) {
            $.ajax({
                type: "GET",
                url: "/antrian/" + unit_id,
                dataType: 'json',
                success: function(response) {

                    var newWin = window.frames["printf"];
                    newWin.document.body.innerHTML = '';
                    newWin.document.write(
                        '<center>' +
                        '<h4>RS PERMATA KUNIGAN</h4>' +
                        '<p style="font-size: 12px">' + response.date + '</p>' +
                        '<span style="display: inline-block;width: 50%;border-top: 2px solid black;"></span>' +
                        '<h1 style="font-size: 46px">' + response.antrian + '</h1>' +
                        '<h6>' + response.unit + '</h6>' +
                        '<span style="display: inline-block;width: 50%;border-top: 2px solid black;"></span>' +
                        '<p>Sisa Antrean : ' + response.rest + '</p>' +
                        '<p style="font-size: 8px">*) Silahkan mengambil nomor antrian baru,<br>jika nomor antrian terlewatkan</p>' +
                        '</center>'
                    );
                    newWin.focus();
                    newWin.print();
                    Swal.fire({
                        title: response.antrian,
                        icon: 'success',
                        timer: 500
                    })
                }
            })
        }
    </script>
</body>

</html>
