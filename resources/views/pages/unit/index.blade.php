@extends('layouts.admin.app')

@section('container')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('unit.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-square-fill"></i> Create</a>
                    <div class="table-responsive mt-2">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: '{{ route('unit.data') }}',
                columns: [{
                        data: 'unit_name',
                        name: 'unit_name'
                    }
                ],
            });
            $(()=>{
                table;
            })
        </script>
    @endpush
@endsection
