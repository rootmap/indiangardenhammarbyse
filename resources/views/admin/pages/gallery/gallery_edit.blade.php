
@extends("admin.layout.master")
@section("title","Edit Gallery")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Gallery</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('galleryphoto/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('galleryphoto/create')}}">Create New </a></li>
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
            <h3 class="card-title">Edit / Modify Gallery</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('galleryphoto/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('galleryphoto/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('galleryphoto/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('galleryphoto/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('galleryphoto/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Choose Category</label>
                          <select class="form-control select2" style="width: 100%;"  id="category" name="category">
                            
                                <option value="">Please Select</option>
                                @if(count($dataRow_Category)>0)
                                    @foreach($dataRow_Category as $Category)
                                        <option 
                                @if(isset($dataRow->id))
                                    @if($dataRow->id==$Category->id)
                                        selected="selected" 
                                    @endif
                                @endif 
                                 value="{{$Category->id}}">{{$Category->name}}</option>
                                        
                                    @endforeach
                                @endif
                                
                          </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="gallery_content">Gallery Content</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->gallery_content)){
                            ?>
                            value="{{$dataRow->gallery_content}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Gallery Content" id="gallery_content" name="gallery_content">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Enter Gallery Image</label>
                            <!-- <label for="customFile">Enter Gallery Image</label> -->
                            <div class="custom-file">
                              <input type="file" class="custom-file-input"  id="gallery_image" name="gallery_image">
                              <input type="hidden" value="{{$dataRow->gallery_image}}" name="ex_gallery_image" />
                              <label class="custom-file-label" for="customFile">Enter Gallery Image</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if(isset($dataRow->gallery_image))
                            @if(!empty($dataRow->gallery_image))
                                <img class="img-thumbnail" src="{{url('upload/gallery/small/'.$dataRow->gallery_image)}}" width="150">
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
              <a class="btn btn-danger" href="{{url('galleryphoto/edit/'.$dataRow->id)}}">
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
@section("css")
    
    <link rel="stylesheet" href="{{url('admin/plugins/select2/css/select2.min.css')}}">
    
@endsection
        
@section("js")

    <script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        $(".select2").select2();
    });
    </script>

    <script src="{{url('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>



      
    $(document).ready(function(){
        bsCustomFileInput.init();
    });
    </script>



@endsection
        