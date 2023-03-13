@extends('layouts.admin.app')

@section('container')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('loket.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Nama Loket</label>
                            <input type="text" name="loket_name"
                                class="form-control @error('loket_name') is-invalid @enderror">
                            @error('loket_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Unit</label>
                            <select name="unit_id" id="unit" onchange="jenisAntrian(this.id)"
                                class="form-select @error('unit_id') is-invalid @enderror">
                                <option value="">--Pilih Unit--</option>
                                @foreach ($unit as $u)
                                    <option value="{{ $u->id }}">{{ $u->unit_name }}</option>
                                @endforeach
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
                                class="form-select @error('queue_type_id') is-invalid @enderror"></select>
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
            var jenisAntrian = function(id) {
                var unit_id = $('#' + id).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('jenis-antrian.dataJson') }}/?unit_id=' + unit_id,
                    dataType: 'json',
                    success: function(data) {
                        var option = "<option value=''>--Pilih Jenis Antrian--</option>";
                        for (var i = 0; i < data.length; i++) {
                            option += "<option value=" + data[i].id + ">" + data[i].name + "</option>";
                        }
                        $("#jenis-antrian").html(option);
                    }
                })
            }
            $(() => {
                @if (session()->has('success'))
                    Swal.fire('{{ session('success') }}', '', 'success');
                @endif

            })
        </script>
    @endpush
@endsection
