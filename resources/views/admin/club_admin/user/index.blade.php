@extends('admin.master')
@section('title')
  <title>Admins</title>
@endsection

@section('breadcrumb')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Admins</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <a class='float-right btn btn-success' href="{{ route('register') }}">Add New</a>
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
        <div class="box-body table-responsive p-0">
          @include('admin.include.messages')
          <table id="players" class="table table-head-fixed text-nowrap table-striped table-bordered">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Username</th>
                <th>email</th>
                <th>Phone #</th>
                <th>Edit</th>
                @if(Auth::user()->super_admin ||Auth::user()->club_id > 0  )<th>Delete</th>@endif
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                    <td>{{ (($page-1)*$records)+($loop->index + 1) }}</td>
                  <td><b>{{ $user->name }}</b></td>
                  <td><b>{{ $user->username }}</b></td>
                  <td>{{ $user->email}}</td>
                  <td>{{ $user->phone}}</td>
                  <td>
                  @if(Auth::user()->super_admin ||$user->id == Auth::id()  || $user->created_by == Auth::id())
                    <a href="{{ route('club_admin.user.edit',$user->id) }}"><span class="fas fa-edit" ></span></a>
                  @endif
                  </td>
                  @if(Auth::user()->super_admin || $user->created_by == Auth::id() )
                  <td>
                    @if (!$user->super_admin)
                        <form id="delete-form-{{ $user->id }}" method="post" action="{{ route('club_admin.user.destroy',$user->id) }}" style="display: none">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        </form>
                        <a href="" onclick="
                        if(confirm('Are you sure, You Want to delete this?'))
                            {
                            event.preventDefault();
                            document.getElementById('delete-form-{{ $user->id }}').submit();
                            }
                            else{
                            event.preventDefault();
                            }" ><span class="fas fa-trash-alt" ></span></a>
                    @endif
                  </td>
                  @endif
                  </tr>
                </tr>
              @endforeach
              </tbody>
          </table>
        </div>
        <!-- /.row -->
      </div>
        <div class="col-sm-12 col-md7">
            {{ $users->links() }}
        </div>
      <!-- ./card-body -->
      <div class="card-footer">

      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
@endsection

