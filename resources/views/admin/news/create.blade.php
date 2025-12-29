@extends('admin.master')
@section('title')
  <title>Create news</title>
@endsection

@section('breadcrumb')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create news</h1>
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
            <form role="form" action="{{ route('news.store') }}" method="post">
                {{ csrf_field() }}
                  <div class="box-body">
                      <div class="offset-lg-3 col-lg-6">
                          @include('admin.include.messages')
                          <div class="form-group">
                              <label for="name">News</label>
                              <textarea class="form-control"  id="name" name="name"  placeholder="news" rows="3" value="{{ old('name') }}"></textarea>
                          </div>


                          <div class="form-group">
                            <label for="status">Status</label>
                            <select class="custom-select" name="status">
                                <option value="true">Show</option>
                                <option value="false">Hide</option>
                            </select>
                          </div>

                          <div class="form-group">
                          <a href='{{ route('news.index') }}' class="btn btn-warning">Back</a>
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
