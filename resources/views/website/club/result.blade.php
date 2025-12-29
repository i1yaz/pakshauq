@extends('website.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="container-fluid content">
        <div class="card card-primary card-tabs">
            {{-- Info:Tournament Tab header --}}
            @include('website.include.card-header')
            {{-- Tournament Detail  --}}
            <div class="card-body">
                @include('website.include.table')
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
@push('js')

@endpush
