@extends('layouts.admin.app')

@section('container')
   
       
   
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col d-flex justify-content-end">

                    <button class="btn btn-sm btn-primary me-1">
                        <i class="bi bi-plus"></i>
                        Admisi
                    </button>
                    <button class="btn btn-sm btn-info text-white ">
                        <i class="bi bi-plus"></i>
                        Farmasi
                    </button>
                </div>
            </div>
            <div class="table-responsive mt-2">

                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th> id</th>
                            <th> name</th>
                            <th> email</th>
                            <th> created_at</th>
                            <th> updated_at</th>
                        </tr>
                        <tr>
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
    </div>
    @push('script')
        <script>
            $(() => {
                $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    ajax: '{{ route('data') }}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at'
                        }
                    ],
                    initComplete: function() {
                        this.api().column(1).each(function() {
                            var column = this;
                            var input = document.createElement('input');
                            $("<input class=form-control>").appendTo($(column.header()))
                                .on('keyup change clear', function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column.search(val ? val : '', true, false).draw();
                                });
                        });
                        this.api().column(2).each(function() {
                            var column = this;
                            var input = document.createElement('input');
                            $("<select class=form-select><option value=''>Semua</option><option value=''>Semua</option></select>").appendTo(
                                    $(column.header()))
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                });
                        });

                    }
                });

            })
        </script>
    @endpush
    <style>
       
    </style>
@endsection
