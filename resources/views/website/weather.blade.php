@extends('website.layouts.master')

@push('css')
@endpush
@section('content')
    <div class="container-fluid content">
        <div class="card card-primary card-tabs">
            <div class="card-header shadow-lg text-color">
            </div>
            {{-- Tournament Detail  --}}
            <div class="card-body">
                <div class="text-center">
                    <iframe width="650" height="450"
                            src="https://embed.windy.com/embed2.html?lat=29.688&lon=74.180&zoom=5&level=surface&overlay=wind&menu=&message=true&marker=true&calendar=12&pressure=&type=map&location=coordinates&detail=true&detailLat=33.064&detailLon=76.465&metricWind=km%2Fh&metricTemp=%C2%B0C&radarRange=-1"
                            frameborder="0"></iframe>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
@push('js')

@endpush
