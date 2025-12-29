@extends('website.layouts.master')

@section('content')
    <div class="container-fluid content">
        <div class="card card-primary card-tabs">
            {{-- Info:Tournament Tab header --}}
            @include('website.include.tabs')
            {{-- Tournament Detail  --}}
            @if ($activeTournaments->count() > 1)
                @include('website.include.card-header')
            @endif
            @include('website.include.table')
            <!-- /.card -->
        </div>
    </div>
@endsection
@push('js')

@endpush
