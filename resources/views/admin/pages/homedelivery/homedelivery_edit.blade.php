
@extends("admin.layout.master")
@section("title","Edit Home Delivery")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Home Delivery</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Home Delivery</li>
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
            <h3 class="card-title">Edit / Modify Home Delivery</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('homedelivery/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="heading">Heading</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->heading)){
                            ?>
                            value="{{$dataRow->heading}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Heading" id="heading" name="heading">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload First Logo</label>
                                    <!-- <label for="customFile">Upload First Logo</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="first_logo" name="first_logo">
                                      <input type="hidden" value="{{$dataRow->first_logo}}" name="ex_first_logo" />
                                      <label class="custom-file-label" for="customFile">Upload First Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->first_logo))
                                    @if(!empty($dataRow->first_logo))
                                        <img class="img-thumbnail" src="{{url('upload/homedelivery/'.$dataRow->first_logo)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="first_logo_link">First Logo Link</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->first_logo_link)){
                            ?>
                            value="{{$dataRow->first_logo_link}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter First Logo Link" id="first_logo_link" name="first_logo_link">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Second Logo</label>
                                    <!-- <label for="customFile">Upload Second Logo</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="second_logo" name="second_logo">
                                      <input type="hidden" value="{{$dataRow->second_logo}}" name="ex_second_logo" />
                                      <label class="custom-file-label" for="customFile">Upload Second Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->second_logo))
                                    @if(!empty($dataRow->second_logo))
                                        <img class="img-thumbnail" src="{{url('upload/homedelivery/'.$dataRow->second_logo)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="second_logo_link">Second Logo Link</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->second_logo_link)){
                            ?>
                            value="{{$dataRow->second_logo_link}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Second Logo Link" id="second_logo_link" name="second_logo_link">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Third Logo</label>
                                    <!-- <label for="customFile">Upload Third Logo</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="third_logo" name="third_logo">
                                      <input type="hidden" value="{{$dataRow->third_logo}}" name="ex_third_logo" />
                                      <label class="custom-file-label" for="customFile">Upload Third Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->third_logo))
                                    @if(!empty($dataRow->third_logo))
                                        <img class="img-thumbnail" src="{{url('upload/homedelivery/'.$dataRow->third_logo)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="third_logo_link">Third Logo Link</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->third_logo_link)){
                            ?>
                            value="{{$dataRow->third_logo_link}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Third Logo Link" id="third_logo_link" name="third_logo_link">
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
              <a class="btn btn-danger" href="{{url('homedelivery/edit/'.$dataRow->id)}}">
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
        