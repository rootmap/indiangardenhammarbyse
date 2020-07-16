
@extends("admin.layout.master")
@section("title","Edit Event Info")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Event Info</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('eventinfo/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('eventinfo/create')}}">Create New </a></li>
              <li class="breadcrumb-item active">Edit / Modify</li>
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
            <h3 class="card-title">Edit / Modify Event Info</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('eventinfo/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('eventinfo/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('eventinfo/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('eventinfo/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('eventinfo/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
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
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Content" id="content" name="content"><?php 
                                if(isset($dataRow->content)){
                                    
                                    echo $dataRow->content;
                                    
                                }
                                ?></textarea>
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Content Image</label>
                                    <!-- <label for="customFile">Choose Content Image</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="content_image" name="content_image">
                                      <input type="hidden" value="{{$dataRow->content_image}}" name="ex_content_image" />
                                      <label class="custom-file-label" for="customFile">Choose Content Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->content_image))
                                    @if(!empty($dataRow->content_image))
                                        <img class="img-thumbnail" src="{{url('upload/eventinfo/'.$dataRow->content_image)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Content Attachment</label>
                                    <!-- <label for="customFile">Choose Content Attachment</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="content_attachment" name="content_attachment">
                                      <input type="hidden" value="{{$dataRow->content_attachment}}" name="ex_content_attachment" />
                                      <label class="custom-file-label" for="customFile">Choose Content Attachment</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a href="{{url('upload/eventinfo/'.$dataRow->content_attachment)}}" class="btn btn-primary">
                                    <i class="fas fa-download"></i> 
                                    Download / Open File
                                </a>
                            </div>
                        </div>
        <div class="row">
            <div class="col-sm-12">
              <!-- radio -->
              <div class="form-group">
              <label>Choose Event Status</label>
        
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->event_expired=="Yes"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="event_expired_0" name="event_expired" value="Yes">
                          <label class="form-check-label">Yes</label>
                        </div>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->event_expired=="No"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="event_expired_1" name="event_expired" value="No">
                          <label class="form-check-label">No</label>
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
              <a class="btn btn-danger" href="{{url('eventinfo/edit/'.$dataRow->id)}}">
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
        