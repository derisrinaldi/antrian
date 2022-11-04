@extends('layouts.caller.app')

@section('container')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="text-center fw-bold fs-4 text-uppercase text-light">
                        nomor antrean sedang berjalan
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="fw-bold" id="antrian" style="font-size:120px">
                                {{ $antrian != null ? $antrian->antrian : '0' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="text-center fw-bold fs-4 text-uppercase text-light">
                        petugas panggil
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 text-center">
                        <h5 class="fw-bold">{{ $loket->loket_name }}</h5>
                    </div>
                    <hr>
                    <div class="row">
                        <label for="" class="col-sm-3">Antrean</label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="0" name="antrean"
                                    id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Normal
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="4" name="antrean"
                                    id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Lewati
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <label for="" class="col-sm-3"></label>
                        <div class="col-sm-9">
                            <div class="d-grid">
                                @php
                                    $v_next = '';
                                    $v_ulang = '';
                                    $v_st_group = '';
                                @endphp
                                @if ($antrian != null && $antrian->status == '1')
                                    @php
                                        $v_next = 'visually-hidden';
                                        @endphp
                                @else
                                @php
                                        $v_ulang = 'visually-hidden';
                                        $v_st_group = 'visually-hidden';
                                    @endphp
                                @endif
                                <button class="btn btn-success {{ $v_next }}" type="button" id="next"
                                    onclick="nextQueue()"><i class="bi bi-ticket-detailed-fill"></i>Antrean
                                    Selanjutnya</button>
                                <button class="btn btn-warning {{ $v_ulang }}" type="button" onclick="ulang()"
                                    id="ulang"><i class="bi bi-megaphone-fill"></i>Panggil Ulang</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <label for="" class="col-sm-3"></label>
                        <div class="col-sm-9">
                            <div class="d-grid {{ $v_st_group }}" id="status-group">
                                <button class="btn btn-info mb-1" onclick="updateStatus('2')"><i
                                        class="bi bi-check"></i>Selesai Dilayani</button>
                                <button class="btn btn-danger mb-1" onclick="updateStatus('3')"><i
                                        class="bi bi-x-circle-fill"></i>Tidak Hadir</button>
                                <button class="btn btn-dark mb-1" onclick="updateStatus('4')"><i
                                        class="bi bi-pause-fill"></i>Lewati</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            var antrian_id = "{{ $antrian != null ? $antrian->id : '0' }}";

            function nextQueue() {
                var a = $("input[name='antrean']").val();
                var data = "l={{ $loket->id }}&a=" + a;
                $.ajax({
                    url: '{{ route('antrian.next') }}',
                    type: "get",
                    data: data,
                    dataType: "json",
                    beforeSend: function() {
                        $('#next').attr('disabled', 'true');
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.status == true) {
                            $("#antrian").html(data.queue.antrian);
                            antrian_id = data.queue.id;
                            $('#next').addClass('visually-hidden');
                            $('#ulang').removeClass('visually-hidden')
                            $('#status-group').removeClass('visually-hidden')
                        } else {
                            $('#next').removeAttr('disabled');
                            Swal.fire('Tidak Ada Nomor Antrian', '', 'info')
                        }
                    }
                })
            }

            function ulang() {
                var data = "a_id=" + antrian_id;
                $.ajax({
                    url: "{{ route('antrian.repeat') }}",
                    type: 'get',
                    data: data,
                    beforeSend: function() {
                        $('#ulang').attr('disabled', 'true');
                    },
                    success: function() {
                        $('#ulang').removeAttr('disabled');
                    }
                })
            }

            function updateStatus(status_id) {
                var title = "";
                switch (status_id) {
                    case "2":
                        title = "Selesai Dilayani";
                        break;
                    case "3":
                        title = "Tidak Hadir";
                        break;
                    case "4":
                        title = "Lewati";
                        break;
                }
                Swal.fire({
                    title: title,
                    icon: "question",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        var data = "a_id=" + antrian_id + "&s=" + status_id;
                        $.ajax({
                            url: "{{ route('antrian.status.update') }}",
                            type: 'get',
                            data: data,
                            beforeSend: function() {
                                $('#ulang').attr('disabled', 'true');
                            },
                            success: function() {
                                $('#next').removeAttr('disabled');
                                $('#ulang').removeAttr('disabled');
                                $('#ulang').addClass('visually-hidden');
                                $('#next').removeClass('visually-hidden')
                                $('#status-group').addClass('visually-hidden')

                            }
                        })
                    }
                })
            }
        </script>
    @endpush
@endsection