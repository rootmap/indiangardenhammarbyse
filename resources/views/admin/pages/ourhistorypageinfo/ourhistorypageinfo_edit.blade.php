
@extends("admin.layout.master")
@section("title","Edit Our History Page Info")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Our History Page Info</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Our History Page Info</li>
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
            <h3 class="card-title">Edit / Modify Our History Page Info</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('ourhistorypageinfo/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="page_heading">Page Heading</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->page_heading)){
                            ?>
                            value="{{$dataRow->page_heading}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Page Heading" id="page_heading" name="page_heading">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Background Image</label>
                                    <!-- <label for="customFile">Upload Background Image</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="background_image" name="background_image">
                                      <input type="hidden" value="{{$dataRow->background_image}}" name="ex_background_image" />
                                      <label class="custom-file-label" for="customFile">Upload Background Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->background_image))
                                    @if(!empty($dataRow->background_image))
                                        <img class="img-thumbnail" src="{{url('upload/ourhistorypageinfo/'.$dataRow->background_image)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="content_heading">Content Heading</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->content_heading)){
                            ?>
                            value="{{$dataRow->content_heading}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Content Heading Title" id="content_heading" name="content_heading">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="content_description">Content Description</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Content Description" id="content_description" name="content_description"><?php 
                                if(isset($dataRow->content_description)){
                                    
                                    echo $dataRow->content_description;
                                    
                                }
                                ?></textarea>
                      </div>
                    </div>
                </div>
                
        <div class="row">
            <div class="col-sm-12">
              <!-- radio -->
              <div class="form-group">
              <label>Choose Module Status</label>
        
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->module_status=="Active"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="module_status_0" name="module_status" value="Active">
                          <label class="form-check-label">Active</label>
                        </div>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->module_status=="Inactive"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="module_status_1" name="module_status" value="Inactive">
                          <label class="form-check-label">Inactive</label>
                        </div>
                
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
              <a class="btn btn-danger" href="{{url('ourhistorypageinfo/edit/'.$dataRow->id)}}">
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
        