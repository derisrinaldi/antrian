@extends('layouts.admin.app')

@section('container')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Jenis Antrian</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('jenis-antrian.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-square-fill"></i>
                        Create</a>
                    <div class="table-responsive mt-2">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Action</th>
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
                ajax: '{{ route('jenis-antrian.datatable') }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                    }
                ],
            });
            $(() => {
                @if (session()->has('success'))
                    Swal.fire('{{ session('success') }}', '', 'success');
                @endif
                
                table;
            })
        </script>
    @endpush
@endsection
