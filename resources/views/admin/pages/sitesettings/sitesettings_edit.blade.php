
@extends("admin.layout.master")
@section("title","Edit Site Settings")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Site Settings</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Site Settings</li>
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
            <h3 class="card-title">Edit / Modify Site Settings</h3>

            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('sitesettings/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('sitesettings/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('sitesettings/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('sitesettings/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('sitesettings/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="site_title">Site Title</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->site_title)){
                            ?>
                            value="{{$dataRow->site_title}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Please Enter Site Title" id="site_title" name="site_title">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Site Logo</label>
                                    <!-- <label for="customFile">Upload Site Logo</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="site_logo" name="site_logo">
                                      <input type="hidden" value="{{$dataRow->site_logo}}" name="ex_site_logo" />
                                      <label class="custom-file-label" for="customFile">Upload Site Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->site_logo))
                                    @if(!empty($dataRow->site_logo))
                                        <img class="img-thumbnail" src="{{url('upload/sitesettings/'.$dataRow->site_logo)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->address)){
                            ?>
                            value="{{$dataRow->address}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Please Enter Address" id="address" name="address">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->phone)){
                            ?>
                            value="{{$dataRow->phone}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Please Enter Phone" id="phone" name="phone">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="email_address">Email Address</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->email_address)){
                            ?>
                            value="{{$dataRow->email_address}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Please Enter Email" id="email_address" name="email_address">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="order_admin_email">Order Admin Email</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->order_admin_email)){
                            ?>
                            value="{{$dataRow->order_admin_email}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Please Enter Order Admin Email" id="order_admin_email" name="order_admin_email">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="reservation_admin_email">Reservation Admin Email</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->reservation_admin_email)){
                            ?>
                            value="{{$dataRow->reservation_admin_email}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Please Enter Reservation Admin Email" id="reservation_admin_email" name="reservation_admin_email">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="contact_map_source_url">Contact MAP Source URL</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->contact_map_source_url)){
                            ?>
                            value="{{$dataRow->contact_map_source_url}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Please Enter Contact MAP Source URL" id="contact_map_source_url" name="contact_map_source_url">
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
              <a class="btn btn-danger" href="{{url('sitesettings/edit/'.$dataRow->id)}}">
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
        