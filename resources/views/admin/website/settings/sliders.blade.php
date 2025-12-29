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
        <div class="box-body table-responsive p-0 offset-lg-3 col-lg-6" >
          @include('admin.include.messages')
          <table class="table table-head-fixed text-nowrap table-striped table-bordered">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Slider</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($sliders as $slider)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td><a target="_blank" href="{{asset('website/sliders/'.$slider->slider)}}">
                  <img src="{{asset('website/sliders/'.$slider->slider)}}" alt="thumbnail" style="width:350px">
                </a></td>
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