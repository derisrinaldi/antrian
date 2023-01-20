@extends('layouts.admin.app')

@section('container')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <div class="row">
        <div class="col-lg-12">
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
                    {!! $chart->script() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div id="app">
                        {!! $bulan_k->container() !!}
                    </div>
                    {!! $bulan_k->script() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div id="app">
                        {!! $bulan->container() !!}
                    </div>
                    {!! $bulan->script() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
