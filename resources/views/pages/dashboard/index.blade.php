@extends('layouts.admin.app')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-1">
                    <label for="">Tanggal</label>
                </div>
                <div class="col-lg-3">
                    <div class="input-group">
                        <input type="date" id="cal" class="form-control" name="date" value="{{ date('Y-m-d') }}">
                        <label class="input-group-text" for="cal"><i class="bi bi-calendar3"></i></label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-sm btn-success" onclick="cari()"><i class="bi bi-search"></i>Cari</button>
                    <button class="btn btn-sm btn-primary"><i class="bi bi-file"></i>Excel</button>

                </div>
            </div>
            <table class="table mt-4" id="table">
                <thead>
                    <tr>
                        <th>Type Loket</th>
                        <th>Nama Loket</th>
                        <th>Nomor</th>
                        <th>Jam Daftar</th>
                        <th>Jam Dipanggil</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('script')
    <script>
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            destroy:true,
            ajax: {
                url:'{{ route('antrian.data') }}'
            },
            columns: [
                {
                    data: 'unit.unit_name',
                    name: 'unit_id'
                },
                {
                    data: 'loket.loket_name',
                    name: 'loket.loket_name'
                },
                {
                    data: 'antrian',
                    name: 'antrian'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ],
            initComplete: function() {
                this.api().column(0).each(function() {
                    var column = this;
                    $(column.header()).empty();
                    $("<select class=form-select><option value=''>Semua</option>@foreach($unit as $u)<option value={{ $u->id }}>{{ $u->unit_name }}</option>@endforeach</select>").appendTo(
                            $(column.header()))
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                });
                this.api().column(1).each(function() {
                    var column = this;
                    $(column.header()).empty();
                    var input = document.createElement('input');
                    $("<input class=form-control>").appendTo($(column.header()))
                        .on('keyup change clear', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column.search(val ? val : '', true, false).draw();
                        });
                });
                this.api().column(2).each(function() {
                    var column = this;
                    $(column.header()).empty();
                    var input = document.createElement('input');
                    $("<input class=form-control>").appendTo($(column.header()))
                        .on('keyup change clear', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column.search(val ? val : '', true, false).draw();
                        });
                });
                this.api().column(3).each(function() {
                    var column = this;
                    $(column.header()).empty();
                    var input = document.createElement('input');
                    $("<input class=form-control>").appendTo($(column.header()))
                        .on('keyup change clear', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column.search(val ? val : '', true, false).draw();
                        });
                });
                this.api().column(5).each(function() {
                    var column = this;
                    $(column.header()).empty();
                    var text = "<select class=form-select>"+
                                "<option value='' selected>Semua</option>"+
                                "<option value='Menunggu'>Menunggu</option>"+
                                "<option value='Sedang Dilayani'>Sedang Dilayani </option>"+
                                "<option value='Selesai'>Selesai </option>"+
                                "<option value='Tidak Hadir'>Tidak Hadir </option>"+
                                "<option value='Lewati'>Lewati </option>"+
                                "</select>";
                    $(text).appendTo($(column.header()))
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                });

            }
        });
        $(() => {
            var tgl = $('#cal').val()
            table.ajax.url('{{ route('antrian.data') }}?tanggal='+$('#cal').val()).load()
        })

        function cari(){
            var tgl = $('#cal').val()
            table.ajax.url('{{ route('antrian.data') }}?tanggal='+$('#cal').val()).load()
        }
    </script>
@endpush
@endsection
