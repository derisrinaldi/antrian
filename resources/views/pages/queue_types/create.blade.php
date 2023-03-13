@extends('layouts.admin.app')

@section('container')
    <div class="row">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Jenis Antrian</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('jenis-antrian.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Unit</label>
                            <select name="unit_id" id=""
                                class="form-select @error('unit_id') is-invalid @enderror">
                                <option value="">--Pilih Unit--</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" @selected(old('unit_id') == $unit->id)>{{ $unit->unit_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Jenis Antrian</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name')
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
