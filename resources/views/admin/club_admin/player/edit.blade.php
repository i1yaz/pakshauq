@extends('admin.master')
@section('title')
  <title>Edit player</title>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
@endpush
@section('breadcrumb')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit player</h1>
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

        <form role="form" action="{{ route('club_admin.player.update',$player->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="box-body">
                <div class="offset-lg-3 col-lg-6">
                     @include('admin.include.messages')
                     <div class="form-group">
                      <label>Profile Image</label>
                         <div class="card text-center">
                             <div class="card-body">
                                 <div class="profile-img">
                                    @php
                                        $picType = config('settings.profile_pic_type');
                                        if ($picType === 'circle') {
                                            $image = asset('website/profiles/profile.png');
                                        }else{
                                            $image = asset('website/profiles/profile-square.png');
                                        }
                                    @endphp
                                    <img src="{{ isset($player->poster) ? asset("website/profiles/{$player->poster}")  :$image}}" id="profile-pic" width="150px" height="150px">
                                 </div>
                                 <div class="btn btn-dark">
                                     <input type="file" class="file-upload" id="file-upload"
                                            accept="image/*" value="" onclick="this.value=null;">
                                     <input type="hidden" name="profile_64" id="profile-64" value="" >
                                 </div>
                             </div>
                         </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Player Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Player Name" value="@if (old('name')){{ old('name') }}@else{{ $player->name }}@endif">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone#</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" value="@if (old('phone')){{ old('phone') }}@else{{ $player->phone }}@endif">
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="city" value="@if (old('city')){{ old('city') }}@else{{ $player->city }}@endif">
                    </div>

                    <div class="form-group">
                        <label for="province">Province</label>
                        <input type="text" class="form-control" id="province" name="province" placeholder="province" value="@if (old('province')){{ old('province') }}@else{{ $player->province }}@endif">
                    </div>


                    <div class="form-group">
                        <a href='{{ route('club_admin.player.index') }}' class="btn btn-warning">Back</a>
                        <button type="submit" class="btn btn-primary float-right">Update</button>
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
    <div class="modal" id="crop-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Crop Image And Upload</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="resizer"></div>
                    <button class="btn rotate float-lef" data-deg="90" >
                        <i class="fas fa-undo"></i></button>
                    <button class="btn rotate float-right" data-deg="-90" >
                        <i class="fas fa-redo"></i></button>
                    <hr>
                    <button class="btn btn-block btn-dark" id="upload"  >
                        Crop And Upload</button>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
@push('js')

    <!-- Croppie js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
    <script>
        $(function() {
            let croppie = null;
            const el = document.getElementById('resizer');

            $.base64ImageToBlob = function(str) {
                // extract content type and base64 payload from original string
                let pos = str.indexOf(';base64,');
                let type = str.substring(5, pos);
                let b64 = str.substr(pos + 8);

                // decode base64
                let imageContent = atob(b64);

                // create an ArrayBuffer and a view (as unsigned 8-bit)
                let buffer = new ArrayBuffer(imageContent.length);
                let view = new Uint8Array(buffer);

                // fill the view, using the decoded base64
                for (let n = 0; n < imageContent.length; n++) {
                    view[n] = imageContent.charCodeAt(n);
                }

                // convert ArrayBuffer to Blob
                let blob = new Blob([buffer], { type: type });

                return blob;
            }

            $.getImage = function(input, croppie) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        croppie.bind({
                            url: e.target.result,
                        });
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#file-upload").on("change", function(event) {
                $("#crop-modal").modal();
                // Initailize croppie instance and assign it to global variable
                croppie = new Croppie(el, {
                    viewport: {
                        width: 200,
                        height: 200,
                        type: '{{ config('settings.profile_pic_type') }}'
                    },
                    boundary: {
                        width: 200,
                        height: 200
                    },

                });
                $.getImage(event.target, croppie);
            });

            $("#upload").on("click", function(e) {
                e.preventDefault();
                croppie.result('base64').then(function(base64) {
                    $("#crop-modal").modal("hide");
                    $("#profile-pic").attr("src","{{asset('img/loader.gif')}}");
                    $("#profile-pic").attr("src", base64);
                    $('#profile-64').attr("value",base64);
                    $('#file-upload').attr("value",base64);
                });
            });

            // To Rotate Image Left or Right
            $(".rotate").on("click", function(e) {
                e.preventDefault()
                croppie.rotate(parseInt($(this).data('deg')));
            });

            $('#crop-modal').on('hidden.bs.modal', function (e) {
                // This function will call immediately after model close
                // To ensure that old croppie instance is destroyed on every model close
                setTimeout(function() { croppie.destroy(); }, 100);
            })

        });

    </script>
@endpush
