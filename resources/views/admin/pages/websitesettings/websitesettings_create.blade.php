
@extends("admin.layout.master")
@section("title","Create New Website Settings")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Website Settings</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Create New Website Settings</li>
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
            <h3 class="card-title">Create New Website Settings</h3>            
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('websitesettings')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="website_meta_data">Website Meta Data</label>
                        <input type="text" class="form-control" placeholder="Enter Website Meta Data" id="website_meta_data" name="website_meta_data">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="website_meta_description">Website Meta Description</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Website Meta Description" id="website_meta_description" name="website_meta_description"></textarea>
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Choose Footer Image</label>
                            <!-- <label for="customFile">Choose Footer Image</label> -->

                            <div class="custom-file">
                              <input type="file" class="custom-file-input"  id="footer_image" name="footer_image">
                              <label class="custom-file-label" for="customFile">Choose Footer Image</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="bottom_icon">Bottom Icon</label>
                        <input type="text" class="form-control" placeholder="Enter Bottom Icon" id="bottom_icon" name="bottom_icon">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="book_table_button_content">Book Table Button Content</label>
                        <input type="text" class="form-control" placeholder="Choose Overlay Opacity" id="book_table_button_content" name="book_table_button_content">
                      </div>
                    </div>
                
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label>Choose Overlay Opacity</label>
                                  <select class="form-control select2" style="width: 100%;"  id="overlay" name="overlay">
                                    
        <option value="">Please select</option>
        @for($i=1; $i<=99; $i++)
            <option value="0.{{ strlen($i)=2?$i:'0'.$i }}">0.{{ strlen($i)=2?$i:'0'.$i }}</option>
        @endfor
        
                                  </select>
                                </div>
                            </div>
                        </div>
                           
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
              <a class="btn btn-danger" href="{{url('websitesettings/create')}}"><i class="far fa-times-circle"></i> Reset</a>
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
@section("css")
    
    <link rel="stylesheet" href="{{url('admin/plugins/select2/css/select2.min.css')}}">
    
@endsection
        
@section("js")

    <script src="{{url('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        bsCustomFileInput.init();
    });
    </script>

    <script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        $(".select2").select2();
    });
    </script>

@endsection
        