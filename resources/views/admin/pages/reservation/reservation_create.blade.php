
@extends("admin.layout.master")
@section("title","Create New Reservation")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Reservation</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Create New Reservation</li>
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
            <h3 class="card-title">Create New Reservation</h3>            
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('reservation-contact')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="page_name">Page Name</label>
                        <input type="text" class="form-control" placeholder="Enter Page Name" id="page_name" name="page_name">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="reservation_form_title">Reservation Form Title</label>
                        <input type="text" class="form-control" placeholder="Enter Reservation Form Title" id="reservation_form_title" name="reservation_form_title">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="reservation_button_title">Reservation Button Title</label>
                        <input type="text" class="form-control" placeholder="Enter Reservation Button Title" id="reservation_button_title" name="reservation_button_title">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Choose Background</label>
                            <!-- <label for="customFile">Choose Background</label> -->

                            <div class="custom-file">
                              <input type="file" class="custom-file-input"  id="fore_ground_image" name="fore_ground_image">
                              <label class="custom-file-label" for="customFile">Choose Background</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="contact_form_title">Contact Form Title</label>
                        <input type="text" class="form-control" placeholder="Enter Contact Form Title" id="contact_form_title" name="contact_form_title">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="contact_button_title">Contact Button Title</label>
                        <input type="text" class="form-control" placeholder="Enter Contact Button Title" id="contact_button_title" name="contact_button_title">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="get_directions">Get Directions</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Get Directions" id="get_directions" name="get_directions"></textarea>
                      </div>
                    </div>

            <div class="col-sm-6">
              <!-- radio -->
              <div class="form-group">
              <label>Choose Module Status</label>
        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" 
                          id="module_status_0" name="module_status" value="Active">
                          <label class="form-check-label">Active</label>
                        </div>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio" 
                          id="module_status_1" name="module_status" value="Inactive">
                          <label class="form-check-label">Inactive</label>
                        </div>
                
                    </div>
                </div>
            </div>
                   
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
              <a class="btn btn-danger" href="{{url('reservation-contact/create')}}"><i class="far fa-times-circle"></i> Reset</a>
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
        