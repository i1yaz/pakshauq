@extends('admin.master')
@section('title')
  <title>Clubs</title>
@endsection

@section('breadcrumb')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Clubs</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <a class='float-right btn btn-success' href="{{ route('club.create') }}">Add New</a>
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
          <table id="clubs" class="table table-head-fixed text-nowrap table-striped table-bordered">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Owner</th>
                <th>Phone #</th>
                <th>City</th>
                <th>Status</th>
                <th>Sort</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($clubs as $club)
                <tr>
                    <td>{{ (($page-1)*$records)+($loop->index + 1) }}</td>
                  <td><b>{{ $club->name }}</b></td>
                  <td>{{ $club->owner}}</td>
                  <td>{{ $club->phone}}</td>
                  <td>{{ $club->city}}</td>
                  <td>
                    @if($club->status)
                    <strong></strong>
                    <span class="badge badge-success">Show</span>
                    @else
                    <span class="badge badge-danger">Hide</span>
                    @endif
                  </td>
                  <td>{{ $club->sort}}</td>
                  <td><a href="{{ route('club.edit',$club->id) }}"><span class="fas fa-edit" ></span></a></td>
                  <td>
                    <form id="delete-form-{{ $club->id }}" method="post" action="{{ route('club.destroy',$club->id) }}" style="display: none">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    </form>
                    <a href="" onclick="
                    if(confirm('Are you sure, You Want to delete this?'))
                        {
                          event.preventDefault();
                          document.getElementById('delete-form-{{ $club->id }}').submit();
                        }
                        else{
                          event.preventDefault();
                        }" ><span class="fas fa-trash-alt" ></span></a>
                  </td>
                </tr>
              @endforeach
              </tbody>
          </table>
        </div>
        <!-- /.row -->
      </div>
        <div class="col-sm-12 col-md7">
            {{ $clubs->links() }}
        </div>
      <!-- ./card-body -->
      <div class="card-footer">

      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
@endsection

