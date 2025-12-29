@extends('admin.master')
@section('title')
  <title>Players</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  <style>
    .dataTables_wrapper  {
        margin-bottom: 1rem;
        margin-top: 1rem;
        margin-left: 0.3rem;
        margin-right: 0.3rem;
    }

</style>
@endsection

@section('breadcrumb')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Players</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <a class='float-right btn btn-success' href="{{ route('club_admin.player.create') }}">Add New</a>
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
          <table id="players" class="table table-head-fixed text-nowrap table-striped table-bordered">
            <thead>
              <tr>
                {{-- <th>S.No</th> --}}
                <th>Player Name</th>
                <th>Club</th>
                <th>Phone #</th>
                <th>City</th>
                <th>Province</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <!-- /.row -->
      </div>
      <div class="col-sm-12 col-md7">
        {{-- {{ $players->links() }} --}}
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
      $(document).ready(function () {
        $('#players').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("club_admin.players.data") }}',
          pageLength: 25,
          columns: [
            // { data: 'index', name: 'index' },
            { data: 'name', name: 'name' },
            { data: 'club', name: 'club' },
            { data: 'phone', name: 'phone' },
            { data: 'city', name: 'city' },
            { data: 'province', name: 'province' },
            { data: 'edit', name: 'edit', orderable: false, searchable: false },
            { data: 'delete', name: 'delete', orderable: false, searchable: false }
          ]
        });
      });
      
      const observer = lozad();
      observer.observe();
    </script>
@endpush
