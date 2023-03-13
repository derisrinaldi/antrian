@extends('layouts.admin.app')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col d-flex justify-content-start">
                    <a class="btn btn-sm btn-primary me-1" href="{{ route('loket.create') }}">
                        <i class="bi bi-plus"></i>
                        Create
                    </a>
                </div>
            </div>
            <div class="table-responsive mt-2">

                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th> Loket</th>
                            <th> Unit</th>
                            <th>Default Jenis Antrian</th>
                            <th> Action</th>
                        </tr>
                    </thead>

                </table>
            </div>

        </div>
    </div>
    @push('script')
        <script>
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: '{{ route('loket.data') }}',
                columns: [{
                        data: 'loket_name',
                        name: 'loket_name'
                    },
                    {
                        data: 'unit.unit_name',
                        name: 'unit.unit_name'
                    },
                    {
                        data: 'queue_type.name',
                        name: 'queue_type.name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                // initComplete: function() {
                //     this.api().column(1).each(function() {
                //         var column = this;
                //         var input = document.createElement('input');
                //         $("<input class=form-control>").appendTo($(column.header()))
                //             .on('keyup change clear', function() {
                //                 var val = $.fn.dataTable.util.escapeRegex($(this).val());

                //                 column.search(val ? val : '', true, false).draw();
                //             });
                //     });
                //     this.api().column(2).each(function() {
                //         var column = this;
                //         var input = document.createElement('input');
                //         $("<select class=form-select><option value=''>Semua</option><option value=''>Semua</option></select>").appendTo(
                //                 $(column.header()))
                //             .on('change', function() {
                //                 var val = $.fn.dataTable.util.escapeRegex($(this).val());

                //                 column.search(val ? '^' + val + '$' : '', true, false).draw();
                //             });
                //     });

                // }
            });

            function addLoket(id) {
                Swal.fire({
                    title: 'Yakin Ingin Menambah Loket?',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        var data = "unit_id=" + id + "&_token={{ csrf_token() }}";
                        $.ajax({
                            type: 'post',
                            data: data,
                            dataType: 'json',
                            url: "{{ route('loket.store') }}",
                            success: function(res) {
                                Swal.fire(res.loket, '', 'success')
                                table.ajax.reload();

                            }

                        })
                    }
                })
            }

            $(() => {
                table;
                @if (session()->has('success'))
                    Swal.fire('{{ session('success') }}', '', 'success');
                @endif
            })
        </script>
    @endpush
    <style>

    </style>
@endsection
