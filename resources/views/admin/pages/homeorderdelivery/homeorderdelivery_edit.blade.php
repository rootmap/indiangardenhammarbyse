
@extends("admin.layout.master")
@section("title","Edit Home Order Delivery")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Home Order Delivery</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Home Order Delivery</li>
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
            <h3 class="card-title">Edit / Modify Home Order Delivery</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('homeorderdelivery/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
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
                        
                        class="form-control" placeholder="Please Enter Heading" id="heading" name="heading">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="first_icon">First Icon</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->first_icon)){
                            ?>
                            value="{{$dataRow->first_icon}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter First Icon" id="first_icon" name="first_icon">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="first_icon_text">First Icon Text</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->first_icon_text)){
                            ?>
                            value="{{$dataRow->first_icon_text}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter First Icon Text" id="first_icon_text" name="first_icon_text">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="second_icon">Second Icon</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->second_icon)){
                            ?>
                            value="{{$dataRow->second_icon}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Second Icon" id="second_icon" name="second_icon">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="second_icon_text">Second Icon Text</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->second_icon_text)){
                            ?>
                            value="{{$dataRow->second_icon_text}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Second Icon Text" id="second_icon_text" name="second_icon_text">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="third_icon">Third Icon</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->third_icon)){
                            ?>
                            value="{{$dataRow->third_icon}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Third Icon" id="third_icon" name="third_icon">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="third_icon_text">Third Icon Text</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->third_icon_text)){
                            ?>
                            value="{{$dataRow->third_icon_text}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Third Icon Text" id="third_icon_text" name="third_icon_text">
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
              <a class="btn btn-danger" href="{{url('homeorderdelivery/edit/'.$dataRow->id)}}">
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