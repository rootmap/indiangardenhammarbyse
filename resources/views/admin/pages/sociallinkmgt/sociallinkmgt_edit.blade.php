
@extends("admin.layout.master")
@section("title","Edit Social Link Mgt")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Social Link Mgt</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Social Link Mgt</li>
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
            <h3 class="card-title">Edit / Modify Social Link Mgt</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('sociallinkmgt/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->facebook)){
                            ?>
                            value="{{$dataRow->facebook}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Facebook" id="facebook" name="facebook">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->twitter)){
                            ?>
                            value="{{$dataRow->twitter}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Twitter Url" id="twitter" name="twitter">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="linkin">Linkin</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->linkin)){
                            ?>
                            value="{{$dataRow->linkin}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Linkin Url" id="linkin" name="linkin">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="google_plus">Google Plus</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->google_plus)){
                            ?>
                            value="{{$dataRow->google_plus}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Google Plus Url" id="google_plus" name="google_plus">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="pinterest">Pinterest</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->pinterest)){
                            ?>
                            value="{{$dataRow->pinterest}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Pinterest Url" id="pinterest" name="pinterest">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->instagram)){
                            ?>
                            value="{{$dataRow->instagram}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Instagram Url" id="instagram" name="instagram">
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
              <a class="btn btn-danger" href="{{url('sociallinkmgt/edit/'.$dataRow->id)}}">
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