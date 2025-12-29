@extends('admin.master')
@section('title')
  <title>Create admin</title>
@endsection
@push('css')
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
@endpush
@section('breadcrumb')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create admin</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
<div class="col-md-12">
    <div class="card card-secondary">
      <div class="card-header">
        <h5 class="card-title"></h5>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
            <form role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                  <div class="box-body">
                      <div class="offset-lg-3 col-lg-6">
                          @include('admin.include.messages')
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="username">{{ __('Username') }}</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="username" value="{{ old('username') }}">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <input type="password" class="form-control password @error('password') is-invalid @enderror" id="password" name="password" placeholder="password" value="">
                                    <span class="form-group-append">
                                        <button class="btn btn-outline-secondary show" type="button" type="button"><i class="fas fa-eye"></i></button>
                                    </span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone">{{ __('Phone#') }}</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                              <label for="city">{{ __('City') }}</label>
                              <input type="text" class="form-control" id="city" name="city" placeholder="city" value="{{ old('city') }}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Tournament') }}</label>
                                <select class="form-control select2 select2-hidden-accessible" name="tournament[]" multiple="multiple"  style="width: 100%;">
                                    @foreach ($tournaments as $tournament)
                                    <option value="{{$tournament->id}}" >{{$tournament->name}}</option>
                                    @endforeach
                                </select>
                                @error('tournament[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                          <div class="form-group">
                            <a href='{{ route('club_admin.user.index') }}' class="btn btn-warning">{{ __('Back') }}</a>
                            <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                          </div>
                      </div>
                  </div>
            </form>
        <!-- /.row -->
      </div>
      <!-- ./card-body -->
      <div class="card-footer">
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
@endsection
@push('js')
    <script>
        $(".show").on('click',function() {
            var $pwd = $(".password");
            if ($pwd.attr('type') === 'password') {
                $pwd.attr('type', 'text');
            } else {
                $pwd.attr('type', 'password');
            }
        });
    </script>
     <!-- select2 -->
  <script src="{{ asset('adminlte/plugins/select2/js/select2.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('.select2').select2();
    });
  </script>
@endpush
