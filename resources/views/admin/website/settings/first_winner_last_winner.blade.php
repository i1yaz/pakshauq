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
          $firstLastWinners = $settings->where('group_type', \App\Models\Admin\Setting::FIRST_WINNER_LAST_WINNER_GROUP)->sortBy('type')->groupBy('type');
      @endphp
      <!-- /.card-header -->
      <div class="card-body">
        <div class="box-body table-responsive p-0">
            <form role="form" action="{{ route('website.first_winner_last_winner') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="row">
                    <div class="col-lg-6">
    
                        <div class="form-group total-winner">
                            <label for="winner">پجن</label>
                            <input type="text" class="form-control" id="pigeons" name="pigeons" value="1" required>
                        </div>
                        <div class="form-group total-winner">
                            <label for="winner">فرسٹ ونر کیلئے کتنےکبوتر بٹھانے لازمی ہیں</label>
                            <input type="text" class="form-control" id="first_winner_condition" name="first_winner_condition" value="1" required>
                        </div>
                        <div class="form-group total-winner">
                            <label for="winner">لاسٹ ونر کیلئے کتنےکبوتر بٹھانے لازمی ہیں</label>
                            <input type="text" class="form-control" id="last_winner_condition" name="last_winner_condition" value="1" required>
                        </div>
    
        
                        <div class="form-group">
                            <a href='{{ route('website.index') }}' class="btn btn-warning">Back</a>
                            <button type="submit" class="btn btn-primary float-right">Save</button>
                        </div>
                    </div>
    
                    <div class="col-lg-6">
                        <table class="table table-head-fixed text-nowrap table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>Pigeons</th>
                                <th>فرسٹ ونرکیلئے</th>
                                <th>لاسٹ ونرکیلئے</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($firstLastWinners as $key => $firstLastWinner)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $firstLastWinner->first()->value }}</td>
                                <td>{{ $firstLastWinner->last()->value }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                          </table>
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