@extends('admin.master')
@section('title')
  <title>News</title>
@endsection

@section('breadcrumb')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">News</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <a class='float-right btn btn-success' href="{{ route('news.create') }}">Add New</a>
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
      <div class="card-body table-responsive p-0">
        @include('admin.include.messages')
        <div class="box-body">
          <table id="News" class="table table-head-fixed text-nowrap table-striped table-bordered">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Show</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($news as $new)
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                  <td><b>{{ $new->name }}</b></td>
                  <td>
                    @if($new->show)
                    <strong></strong>
                    <span class="badge badge-success">Show</span>
                    @else
                    <span class="badge badge-danger">Hide</span>
                    @endif
                  </td>
                  <td><a href="{{ route('news.edit',$new->id) }}"><span class="fas fa-edit" ></span></a></td>
                  <td>
                    <form id="delete-form-{{ $new->id }}" method="post" action="{{ route('news.destroy',$new->id) }}" style="display: none">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    </form>
                    <a href="" onclick="
                    if(confirm('Are you sure, You Want to delete this?'))
                        {
                          event.preventDefault();
                          document.getElementById('delete-form-{{ $new->id }}').submit();
                        }
                        else{
                          event.preventDefault();
                        }" ><span class="fas fa-trash-alt" ></span></a>
                  </td>
                  </tr>
                </tr>
              @endforeach
              </tbody>
          </table>
        </div>
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
