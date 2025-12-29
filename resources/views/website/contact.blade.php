@extends('website.layouts.master')

@push('css')
@endpush
@section('content')
    <div class="container-fluid content">
        <div class="card card-primary card-tabs">
            <div class="card-header  shadow-lg text-light">
                <h3>Contact us</h3>
            </div>
            {{-- Tournament Detail  --}}
            <div class="card-body">
                <div class="row" id="content">
                    <div class="col-lg-12">
                        <strong>{{ config('settings.contact.name') }}</strong><br>

                        @php
                            $rawPhone = config('settings.contact.phone');
                            $waPhone = preg_replace('/\D+/', '', $rawPhone);
                        @endphp

                        <a href="https://wa.me/{{ $waPhone }}" target="_blank" rel="noopener"
                            class="text-decoration-none">

                            <span class="d-inline-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="16" height="16"
                                    fill="currentColor" class="me-2 wa-icon" style="margin-top:10px">
                                    <path
                                        d="M19.11 17.23c-.27-.14-1.6-.79-1.85-.88-.25-.09-.43-.14-.61.14-.18.27-.7.88-.86 1.06-.16.18-.32.2-.6.07-.27-.14-1.13-.42-2.15-1.33-.79-.7-1.33-1.57-1.48-1.84-.16-.27-.02-.42.12-.55.12-.12.27-.32.41-.48.14-.16.18-.27.27-.45.09-.18.05-.34-.02-.48-.07-.14-.61-1.48-.84-2.02-.22-.53-.44-.46-.61-.46-.16 0-.34 0-.52 0-.18 0-.48.07-.73.34-.25.27-.96.94-.96 2.3s.98 2.67 1.11 2.85c.14.18 1.93 2.95 4.68 4.13.65.28 1.16.45 1.55.58.65.21 1.25.18 1.72.11.52-.08 1.6-.65 1.82-1.27.22-.61.22-1.13.16-1.24-.05-.11-.25-.18-.52-.32z" />
                                    <path
                                        d="M16.02 3.2c-7.06 0-12.8 5.74-12.8 12.8 0 2.26.59 4.46 1.71 6.39L3.2 28.8l6.58-1.71c1.87 1.02 3.98 1.55 6.24 1.55 7.06 0 12.8-5.74 12.8-12.8S23.08 3.2 16.02 3.2zm0 23.07c-2.1 0-4.15-.56-5.92-1.61l-.42-.25-3.9 1.01 1.04-3.79-.27-.44a10.2 10.2 0 1 1 9.47 5.08z" />
                                </svg>

                                <span>{{ $rawPhone }}</span>
                            </span>
                        </a>
                    </div>

                    <style>
                        .wa-icon {
                            color: #25D366;
                            /* WhatsApp green */
                            flex-shrink: 0;
                        }
                    </style>

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
@push('js')
@endpush
