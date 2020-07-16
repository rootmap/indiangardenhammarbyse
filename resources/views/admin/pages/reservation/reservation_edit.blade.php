
@extends("admin.layout.master")
@section("title","Edit Reservation")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Reservation</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Reservation</li>
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
            <h3 class="card-title">Edit / Modify Reservation</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('reservation-contact/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="page_name">Page Name</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->page_name)){
                            ?>
                            value="{{$dataRow->page_name}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Page Name" id="page_name" name="page_name">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="reservation_form_title">Reservation Form Title</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->reservation_form_title)){
                            ?>
                            value="{{$dataRow->reservation_form_title}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Reservation Form Title" id="reservation_form_title" name="reservation_form_title">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="reservation_button_title">Reservation Button Title</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->reservation_button_title)){
                            ?>
                            value="{{$dataRow->reservation_button_title}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Reservation Button Title" id="reservation_button_title" name="reservation_button_title">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Background</label>
                                    <!-- <label for="customFile">Choose Background</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="fore_ground_image" name="fore_ground_image">
                                      <input type="hidden" value="{{$dataRow->fore_ground_image}}" name="ex_fore_ground_image" />
                                      <label class="custom-file-label" for="customFile">Choose Background</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->fore_ground_image))
                                    @if(!empty($dataRow->fore_ground_image))
                                        <img class="img-thumbnail" src="{{url('upload/reservation/'.$dataRow->fore_ground_image)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="contact_form_title">Contact Form Title</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->contact_form_title)){
                            ?>
                            value="{{$dataRow->contact_form_title}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Contact Form Title" id="contact_form_title" name="contact_form_title">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="contact_button_title">Contact Button Title</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->contact_button_title)){
                            ?>
                            value="{{$dataRow->contact_button_title}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Contact Button Title" id="contact_button_title" name="contact_button_title">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="get_directions">Get Directions</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Get Directions" id="get_directions" name="get_directions"><?php 
                                if(isset($dataRow->get_directions)){
                                    
                                    echo $dataRow->get_directions;
                                    
                                }
                                ?></textarea>
                      </div>
                    </div>

            <div class="col-sm-6">
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
              <a class="btn btn-danger" href="{{url('reservation-contact/edit/'.$dataRow->id)}}">
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
        