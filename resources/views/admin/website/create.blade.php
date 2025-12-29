@extends('admin.master')
@section('title')
<title>Add Sliders</title>
@endsection

@section('breadcrumb')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Add Sliders</h1>
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

        <form role="form" action="{{ route('website.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="box-body">
            <div class="offset-lg-3 col-lg-6">
                  @include('admin.include.messages')

                  <div class="form-group total-sliders">
                    <label for="slider">Total Slider</label>
                    <input type="text" class="form-control" id="slider" name="slider" value="0" required>
                  </div>

                <div class="form-group">
                    <a href='{{ route('website.index') }}' class="btn btn-warning">Back</a>
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
@push('js')
<script>
    $('#slider').on('change keyup',function (e) {
          $('.slider').remove();
          let total = $('#slider').val();
          for (let index = 0; index < total; index++) {
            $('.total-sliders').after(
                '<div class="form-group slider-'+(total-index)+' slider">\n' +
                    '<label for="slider-'+(total-index+1)+'"> slider '+(total-index)+'</label>\n' +
                    '<input type="file" class="form-control" id="slider-'+(total-index)+'" name="sliders['+(total-index)+']" value="" required>\n' +
                '</div>'
            );
          }
        });
      </script>
@endpush
