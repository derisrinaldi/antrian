@extends('layouts.admin.app')

@section('container')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('loket.update', $loket->id) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Nama Loket</label>
                            <input type="text" name="loket_name"
                                class="form-control @error('loket_name') is-invalid @enderror"
                                value="{{ old('loket_name', $loket->loket_name) }}">
                            @error('loket_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Default Unit</label>
                            <select name="unit_id" id=""
                                class="form-select @error('unit_id') is-invalid @enderror" disabled>
                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                            </select>
                            @error('unit_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="">Default Jenis Antrian</label>
                            <select name="queue_type_id" id="jenis-antrian"
                                class="form-select @error('queue_type_id') is-invalid @enderror">
                                @foreach ($queue_types as $queue_type)
                                    <option value="{{ $queue_type->id }}">{{ $queue_type->name }}</option>
                                @endforeach
                            </select>
                            @error('queue_type_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <button class="btn btn-sm btn-primary"><i class="bi bi-save"></i> Simpan</button>
                        </div>
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
