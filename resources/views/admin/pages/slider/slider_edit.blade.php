
@extends("admin.layout.master")
@section("title","Edit Slider")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Slider</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Slider</li>
            </ol>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include("admin.include.msg")
        </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-8 offset-2">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit / Modify Slider</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('slider/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload background image</label>
                                    <!-- <label for="customFile">Upload background image</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="background_image" name="background_image">
                                      <input type="hidden" value="{{$dataRow->background_image}}" name="ex_background_image" />
                                      <label class="custom-file-label" for="customFile">Upload background image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->background_image))
                                    @if(!empty($dataRow->background_image))
                                        <img class="img-thumbnail" src="{{url('upload/slider/'.$dataRow->background_image)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Slider image</label>
                                    <!-- <label for="customFile">Upload Slider image</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="slider_image" name="slider_image">
                                      <input type="hidden" value="{{$dataRow->slider_image}}" name="ex_slider_image" />
                                      <label class="custom-file-label" for="customFile">Upload Slider image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->slider_image))
                                    @if(!empty($dataRow->slider_image))
                                        <img class="img-thumbnail" src="{{url('upload/slider/'.$dataRow->slider_image)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="slider_title">Slider Title</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->slider_title)){
                            ?>
                            value="{{$dataRow->slider_title}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Title" id="slider_title" name="slider_title">
                      </div>
                    </div>
                </div>
                       
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> 
                Update
              </button>
              <a class="btn btn-danger" href="{{url('slider/edit/'.$dataRow->id)}}">
                <i class="far fa-times-circle"></i> 
                Reset
              </a>
            </div>
          </form>
        </div>
        <!-- /.card -->

      </div>
      <!--/.col (left) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection
@section("js")

    <script src="{{url('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        bsCustomFileInput.init();
    });
    </script>

@endsection
        