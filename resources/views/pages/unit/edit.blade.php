@extends('layouts.admin.app')

@section('container')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('unit.update',$unit->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <label for="">Nama Unit</label>
                            <input type="text" class="form-control @error('unit_name') is-invalid @enderror"
                                name="unit_name" value="{{ old('unit_name',$unit->unit_name) }}">
                            @error('unit_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button class="btn btn-sm btn-primary"><i class="bi bi-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(() => {
                @if (session()->has('success'))
                    Swal.fire('{{ session('success') }}', '', 'success');
                @endif

            })
        </script>
    @endpush
@endsection
