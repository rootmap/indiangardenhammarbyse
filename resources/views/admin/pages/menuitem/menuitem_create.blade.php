
@extends("admin.layout.master")
@section("title","Create New Menu Item")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Menu Item</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('menuitem/list')}}">Menu Item Data</a></li>
              <li class="breadcrumb-item active">Create New Menu Item</li>
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
            <h3 class="card-title">Create New Menu Item</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item"><a class="page-link bg-primary" href="{{url('menuitem/list')}}"> Data <i class="fas fa-table"></i></a></li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('menuitem/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('menuitem/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>            
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('menuitem')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">

                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Choose Category</label>
                        <select class="form-control select2" style="width: 100%;"  id="category" name="category">
                              <option value="">Please Select</option>
                              @if(isset($dataRow_Category))    
                                  @if(count($dataRow_Category)>0)
                                      @foreach($dataRow_Category as $Category)
                                          <option value="{{$Category->id}}">{{$Category->name}}</option>
                                          
                                      @endforeach
                                  @endif
                              @endif 
                              
                        </select>
                      </div>
                  </div>

                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Choose Sub-Category</label>
                          <select class="form-control select2" style="width: 100%;"  id="subcategory" name="sub_category">
                                <option value="">Please Select</option>                                
                          </select>
                        </div>
                    </div>

                    
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Enter Menu Item Name" id="name" name="name">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Description" id="description" name="description"></textarea>
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" placeholder="Enter Description" id="price" name="price">
                      </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Choose Menu Item Image</label>
                            <!-- <label for="customFile">Choose Menu Item Image</label> -->

                            <div class="custom-file">
                              <input type="file" class="custom-file-input"  id="menu_item_image" name="menu_item_image">
                              <label class="custom-file-label" for="customFile">Choose Menu Item Image</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                    <!-- checkbox -->
                      <div class="form-group">
                      <label>Special</label>
              
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" 
                                id="special_0" name="special" value="Yes">
                                <label class="form-check-label">Yes</label>
                              </div>
                      
                      </div>
                    </div>

                  <div class="col-sm-6">
                  <!-- checkbox -->
                  <div class="form-group">
                  <label>Spicy</label>
            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                              id="spicy_0" name="spicy" value="Yes">
                              <label class="form-check-label">Yes</label>
                            </div>
                    
                        </div>
                    </div>
                </div>
                   
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
              <a class="btn btn-danger" href="{{url('menuitem/create')}}"><i class="far fa-times-circle"></i> Reset</a>
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
    var SubCategory=<?php echo json_encode($SubCategory); ?>;

    

    $(document).ready(function(){
        $(".select2").select2();
        $(".select22").select2();

        $("#category").change(function(){
            var cid=$(this).val();
            var optionHtml='';
            optionHtml+='<option value="">Please Select</option>';
            $.each(SubCategory,function(key,val){
              if(cid==val.category_id)
              {
                  optionHtml+='<option value="'+val.id+'">'+val.name+'</option>';
              }
              
            });
            $("#subcategory").html(optionHtml);
            $("#subcategory").select2();
        });
    });
    </script>

    <script src="{{url('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        bsCustomFileInput.init();
    });
    </script>

@endsection
        