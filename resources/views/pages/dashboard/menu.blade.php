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
        /* Show it is fixed to the top */
        html,
        body {
            margin: 0;
            height: 100%;
        }

        body {
            background-image: linear-gradient(180deg, #61099c, #cc8af8, #f2e0ff);
        }

        .card {
            box-shadow: 5px 5px 10px black;
        }
    </style>
    @stack('style')
</head>

<body>
    <div class="container ">
        <div class="row pt-5 mb-5">
            <div class="col text-center">
                <h1 class="mb-2 text-light" style="font-size: 65px">Dashboard</h1>
                <h2 class="text-light" style="font-size:30px"><i>{{ env('APP_NAME') }}</i></h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card text-white bg-primary" id="card1" onclick="openCard(this.id,'form1')">
                    <div class="card-body text-center">
                        <h5 class="card-title text-uppercase">console box</h5>
                        <div class="form-group visually-hidden" id="form1">
                            <select name="" id="console" class="form-select mb-2">
                                @foreach ($queue_types as $queue_type)
                                    <option value="{{ Crypt::encrypt($queue_type->id) }}">
                                        {{ $queue_type->unit->unit_name . ' - ' . $queue_type->name }}</option>
                                @endforeach
                            </select>

                            <label for="" class="mb-1">Pilih Console ke 2 jika perlu</label>
                            <select name="" id="console2" class="form-select mb-2">
                                <option value="{{ Crypt::encrypt('nothing') }}">--Pilih Console ke 2--</option>
                                @foreach ($queue_types as $queue_type)
                                    <option value="{{ Crypt::encrypt($queue_type->id) }}">
                                        {{ $queue_type->unit->unit_name . ' - ' . $queue_type->name }}</option>
                                @endforeach
                            </select>

                            <label for="" class="mb-1">Pilih Console ke 3 jika perlu</label>
                            <select name="" id="console3" class="form-select mb-2">
                                <option value="{{ Crypt::encrypt('nothing') }}">--Pilih Console ke 3--</option>
                                @foreach ($queue_types as $queue_type)
                                    <option value="{{ Crypt::encrypt($queue_type->id) }}">
                                        {{ $queue_type->unit->unit_name . ' - ' . $queue_type->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-danger" onclick="openConsole('console')">Open</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-warning" id="card2" onclick="openCard(this.id,'form2')">
                    <div class="card-body text-center">
                        <h5 class="card-title text-uppercase">Petugas Panggil</h5>
                        <div class="form-group  visually-hidden" id="form2">
                            <select name="" id="queue_type_caller" class="form-select mb-2"
                                onchange="getLoket(this.id,'caller')">
                                @foreach ($unit as $u)
                                    <option value="{{ $u->id }}">{{ $u->unit_name }}</option>
                                @endforeach
                            </select>
                            <select name="" id="caller" class="form-select mb-2">

                            </select>
                            <button class="btn btn-danger" onclick="openCaller()">Open</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-success" id="card3" onclick="openCard(this.id,'form3')">
                    <div class="card-body text-center">
                        <h5 class="card-title text-uppercase">Display</h5>
                        <div class="form-group  visually-hidden" id="form3">
                            <select name="" id="unit_display" class="form-select mb-2"
                                onchange="getLoketDisplay(this.id,'display')">
                                @foreach ($unit as $u)
                                    <option value="{{ $u->id }}">{{ $u->unit_name }}</option>
                                @endforeach
                            </select>
                            <select name="" id="display" class="form-select mb-2">
                                
                            </select>
                            <button class="btn btn-danger" onclick="openDisplay()">Open</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-secondary" id="card4" onclick="openCard(this.id,'form4')">
                    <div class="card-body text-center">
                        <h5 class="card-title text-uppercase">administrator</h5>
                        <div class="form-group  visually-hidden" id="form4">
                            <button class="btn btn-danger"
                                onclick="return window.open('{{ route('admin') }}','_blank')">Open</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(() => {
            $('#queue_type_caller').trigger('change')
            $('#unit_display').trigger('change')
        })
        var DataLoket = {
            @foreach ($unit as $u)
                @if ($u->loket->count() != 0)
                    {{ $u->id }}: {
                        loket: [
                            @foreach ($u->loket as $l)
                                {
                                    id: '{{ $l->id }}',
                                    value: '{{ $l->loket_name . ' - ' . $l->queueType->name }}',
                                },
                            @endforeach
                        ]
                    },
                @endif
            @endforeach ()
        };

        function openCard(id, formId) {
            console.log(id)
            $('.form-group').addClass('visually-hidden');
            $('#' + formId).removeClass('visually-hidden')
        }

        function openConsole(id) {
            var queue_type = $('#' + id).val();
            var queue_type2 = $('#console2').val();
            var queue_type3 = $('#console3').val();
            window.open('/console/' + queue_type + '/' + queue_type2 + '/' + queue_type3, '_blank')
        }

        function openCaller() {
            var loket = $('#caller').val();
            window.open('/caller/' + loket, '_blank')
        }

        function openDisplay() {
            var loket = $('#display').val();
            window.open('/display/' + loket, '_blank')
        }

        function getLoket(id, dest) {
            var unit = $("#" + id).val();
            var d_loket = DataLoket[unit].loket;
            var text = "";
            if (d_loket.length != 0) {
                for (var i = 0; i < d_loket.length; i++) {
                    text += '<option value="' + d_loket[i].id + '">' + d_loket[i].value + '</option>'
                }
            }else{
                text +="<option></option>";
            }
            $('#' + dest).html(text);
        }

        function getLoketDisplay(id, dest) {
            var unit = $("#" + id).val();
            var d_loket = DataLoket[unit].loket;
            var text = '<option value="all-'+unit+'">Semua Loket</option>';
            for (var i = 0; i < d_loket.length; i++) {
                text += '<option value="' + d_loket[i].id + '">' + d_loket[i].value + '</option>'
            }
            $('#' + dest).html(text);
        }
    </script>
</body>

</html>
