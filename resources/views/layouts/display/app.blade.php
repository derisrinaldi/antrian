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
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="border-radius: 0px;box-shadow:5px 5px 5px #888888">
                    <div class="card-header" style="background-color: #1abc9c;border-radius: 0px">
                        <div class="text-center fw-bold fs-2 text-uppercase text-light">
                            Antrian dipanggil
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="fw-bold" id="antrian" style="font-size:120px">0</div>
                        <div class="fw-bold mt-2" id="loket" style="font-size: 50px; line-height: 0.8;">Loket 1
                        </div>
                        <hr style="border-color: #1ABC9C;">
                        <div class="text-uppercase" style="font-size: 30px; margin-top: 0px; line-height: 0.8;">antrian
                            admisi</div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-6">
                <div class="card">
                    <div class="ratio ratio-16x9">
                        {{-- <object data="http://www.youtube.com/v/R_FfqwidEFM" type="application/x-shockwave-flash">
                            <param name="src" value="http://www.youtube.com/v/R_FfqwidEFM" />
                        </object>   
                    </div>

                </div>
            </div> --}}
        </div>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        window.laravel_echo_port = '{{ env('LARAVEL_ECHO_PORT') }}';
    </script>
    <script src="//{{ Request::getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script>
    <script src="{{ asset('js/laravel-echo-setup.js') }}" type="text/javascript"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=GquJ1oQq"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js"></script>
    <script></script>
    <script type="text/javascript">
        window.Echo.channel('coba')
            .listen('.UserEvent', (data) => {
                console.log(data)
                $('#antrian').html(data.antrian);
                $('#loket').html(data.loket);
                var sound = new Howl({
                    src: ['{{ asset('audio/airport.mp3') }}'],
                    volume: 0.7,
                    onend: function() {
                        responsiveVoice.speak("Antrian, " + data.antrian + ", " + data.loket + ".",
                            "Indonesian Male", {
                                pitch: 1,
                                rate: 0.8
                            });
                    }
                });
                sound.play()
            });
    </script>
    @stack('script')

</body>

</html>