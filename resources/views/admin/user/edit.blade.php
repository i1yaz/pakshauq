@extends('admin.master')
@section('title')
  <title>Edit admin</title>
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
                    <h1 class="m-0 text-dark">Edit admin</h1>
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
            <form role="form" method="POST" action="{{ route('user.update',$user->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                  <div class="box-body">
                      <div class="offset-lg-3 col-lg-6">
                          @include('admin.include.messages')
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="@if (old('name')){{ old('name') }}@else{{ $user->name }}@endif">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="username">{{ __('Username') }}</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="username" value="@if (old('username')){{ old('username') }}@else{{ $user->username }}@endif">
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
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="phone" value="@if (old('phone')){{ old('phone') }}@else{{ $user->phone }}@endif">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                              <label for="city">{{ __('City') }}</label>
                              <input type="text" class="form-control" id="city" name="city" placeholder="city" value="@if (old('city')){{ old('city') }}@else{{ $user->city }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email" value="@if (old('email')){{ old('email') }}@else{{ $user->email }}@endif">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @if (!$user->super_admin)
                            <div class="form-group">
                                <label>{{ __('Tournament') }}</label>
                                <select class="form-control select2 select2-hidden-accessible @error('tournament') is-invalid @enderror" name="tournament[]" multiple="multiple"  style="width: 100%;">
                                    @foreach ($tournaments as $tournament)
                                    <option @if(in_array($tournament->id,$tournamentsOfThisUser->pluck('tournament_id')->toArray())) selected="selected" @endif value="{{$tournament->id}}" >{{$tournament->name}}</option>
                                    @endforeach
                                </select>
                                @error('tournament')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @endif

                            @if (!$user->super_admin)
                            <div class="form-group">
                                <label>{{ __('Club') }}</label>
                                <select class="form-control select2 select2-hidden-accessible @error('club') is-invalid @enderror" name="club"  style="width: 100%;">
                                    @foreach ($clubs as $club)
                                        @if ($loop->first)
                                        <option value=""  selected>{{ __('No Selection') }}</option> 
                                        @endif
                                    <option @if($club->id == $user->club_id) selected="selected" @endif value="{{$club->id}}" >{{$club->name}}</option>
                                    @endforeach
                                </select>
                                @error('club')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @endif


                          <div class="form-group">
                            <a href='{{ route('user.index') }}' class="btn btn-warning">{{ __('Back') }}</a>
                            <button type="submit" class="btn btn-primary float-right">{{ __('Update') }}</button>
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
