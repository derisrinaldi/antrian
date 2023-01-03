@extends('layouts.admin.app')

@section('container')
    <div class="card">
        <div class="card-body">
            <form action="{{ url('/dashboard/chart') }}" method="GET">
                <div class="row">
                    <div class="col-lg-1">
                        <label for="">Tanggal</label>
                    </div>

                    <div class="col-lg-3">
                        <div class="input-group">
                            <input type="date" id="cal" class="form-control" name="tanggal"
                                value="{{ $tanggal ?? date('Y-m-d') }}">
                            <label class="input-group-text" for="cal"><i class="bi bi-calendar3"></i></label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-sm btn-success"><i class="bi bi-search"></i>Cari</button>
                    </div>
                </div>
            </form>
            <div id="app">
                {!! $chart->container() !!}
            </div>
            <script src="https://unpkg.com/vue"></script>
            <script>
                var app = new Vue({
                    el: '#app',
                });
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
            {!! $chart->script() !!}
        </div>
    </div>
@endsection
