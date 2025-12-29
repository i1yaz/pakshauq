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
      @php
          $key = $settings->where('key', 'auto_update_time')->first();
      @endphp
      <!-- /.card-header -->
      <div class="card-body">
        <div class="box-body table-responsive p-0">
            <form role="form" action="{{ route('website.auto_update_time') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="offset-lg-3 col-lg-6">
    
                    <div class="form-group">
                        <label>Auto Update Time of Player In All Tournaments</label>
                        <select class="form-control select2 select2-hidden-accessible" name="auto_update_time"   style="width: 100%;">
                          <option value="1" @if($key->value==1) selected="selected" @endif>Yes</option>
                          <option value="0"@if($key->value==0) selected="selected" @endif>No</option>
                        </select>
                    </div>
    
                    <div class="form-group">
                        <a href='{{ route('website.index') }}' class="btn btn-warning">Back</a>
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                    </div>
                </div>
              </div>
            </form>
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