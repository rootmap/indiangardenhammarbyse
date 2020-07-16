
@extends("admin.layout.master")
@section("title","Edit We Are Open")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>We Are Open</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update We Are Open</li>
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
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit / Modify We Are Open</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('weareopen/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-6">
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
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="sub_heading">Sub Heading</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->sub_heading)){
                            ?>
                            value="{{$dataRow->sub_heading}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Sub Heading" id="sub_heading" name="sub_heading">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="first_box_icon">First Box Icon</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->first_box_icon)){
                            ?>
                            value="{{$dataRow->first_box_icon}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter First Box Icon" id="first_box_icon" name="first_box_icon">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="first_box_heading">First Box Heading</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->first_box_heading)){
                            ?>
                            value="{{$dataRow->first_box_heading}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter First Box Heading" id="first_box_heading" name="first_box_heading">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="first_box_sub_heading">First Box Sub Heading</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->first_box_sub_heading)){
                            ?>
                            value="{{$dataRow->first_box_sub_heading}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter First Box Sub Heading" id="first_box_sub_heading" name="first_box_sub_heading">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="second_box_icon">Second Box Icon</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->second_box_icon)){
                            ?>
                            value="{{$dataRow->second_box_icon}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Second Box Icon" id="second_box_icon" name="second_box_icon">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="second_box_heading">Second Box Heading</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->second_box_heading)){
                            ?>
                            value="{{$dataRow->second_box_heading}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Second Box Heading" id="second_box_heading" name="second_box_heading">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="second_box_sub_heading">Second Box Sub Heading</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->second_box_sub_heading)){
                            ?>
                            value="{{$dataRow->second_box_sub_heading}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Second Box Sub Heading" id="second_box_sub_heading" name="second_box_sub_heading">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="third_box_icon">Third Box Icon</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->third_box_icon)){
                            ?>
                            value="{{$dataRow->third_box_icon}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Third Box Icon" id="third_box_icon" name="third_box_icon">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="third_box_heading">Third Box Heading</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->third_box_heading)){
                            ?>
                            value="{{$dataRow->third_box_heading}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Third Box Heading" id="third_box_heading" name="third_box_heading">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="third_box_sub_heading">Third Box Sub Heading</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->third_box_sub_heading)){
                            ?>
                            value="{{$dataRow->third_box_sub_heading}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Third Box Sub Heading" id="third_box_sub_heading" name="third_box_sub_heading">
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Choose Backgroung Image</label>
                          <!-- <label for="customFile">Choose Footer Image</label> -->
                          <div class="custom-file">
                            <input type="file" class="custom-file-input"  id="background_image" name="background_image">
                            <input type="hidden" value="{{$dataRow->background_image}}" name="ex_backdroung_image" />
                            <label class="custom-file-label" for="customFile">Choose Backgroung Image</label>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      @if(isset($dataRow->background_image))
                          @if(!empty($dataRow->background_image))
                              <img class="img-thumbnail" src="{{url('upload/weareopen/'.$dataRow->background_image)}}" width="150">
                          @endif
                      @endif
                  </div>
                </div>   
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> 
                Update
              </button>
              <a class="btn btn-danger" href="{{url('weareopen/edit/'.$dataRow->id)}}">
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