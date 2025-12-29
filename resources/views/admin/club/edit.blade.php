@extends('admin.master')
@section('title')
  <title>Edit club</title>
@endsection

@section('breadcrumb')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit club</h1>
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
            <form role="form" action="{{ route('club.update',$club->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                  <div class="box-body">
                      <div class="offset-lg-3 col-lg-6">
                          @include('admin.include.messages')
                          <div class="form-group">
                              <label for="name">Club Name</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="club Name" value="@if (old('name')){{ old('name') }}@else{{ $club->name }}@endif">
                          </div>

                          <div class="form-group">
                            <label for="owner">Owner</label>
                            <input type="text" class="form-control" id="owner" name="owner" placeholder="owner" value="@if (old('owner')){{ old('owner') }}@else{{ $club->owner }}@endif">
                        </div>

                          <div class="form-group">
                              <label for="phone">Phone#</label>
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" value="@if (old('phone')){{ old('phone') }}@else{{ $club->phone }}@endif">
                          </div>

                          <div class="form-group">
                            <label for="sort">Sort</label>
                            <input type="text" class="form-control" id="sort" name="sort" placeholder="sort" value="@if (old('sort')){{ old('sort') }}@else{{ $club->sort }}@endif">
                          </div>

                          <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="city" value="@if (old('city')){{ old('city') }}@else{{ $club->city }}@endif">
                          </div>

                          <div class="form-group">
                            <label for="status">Status</label>
                            <select class="custom-select" name="status">
                                <option value="true"  @if($club->status === 1) selected="selected" @endif>Show</option>
                                <option value="false" @if($club->status === 0) selected="selected" @endif>Hide</option>
                            </select>
                          </div>

                          <div class="form-group">
                          <a href='{{ route('club.index') }}' class="btn btn-warning">Back</a>
                          <button type="submit" class="btn btn-primary float-right">Save</button>
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
