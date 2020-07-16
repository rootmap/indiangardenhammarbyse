
@extends("admin.layout.master")
@section("title","Edit Menu Item")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Menu Item</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('menuitem/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('menuitem/create')}}">Create New </a></li>
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
            <h3 class="card-title">Edit / Modify Menu Item</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('menuitem/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('menuitem/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
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
          <form action="{{url('menuitem/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
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
                                @if(isset($dataRow->category))
                                    @if($dataRow->category==$Category->id)
                                        selected="selected" 
                                    @endif
                                @endif 
                                 value="{{$Category->id}}">{{$Category->name}}</option>
                                        
                                    @endforeach
                                @endif
                                
                          </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Choose Sub-Category</label>
                          <select class="form-control select2" style="width: 100%;"  id="subcategory" name="sub_category">
                                <option value="{{$dataRow->sub_category_id}}">{{$dataRow->sub_category_name}}</option>                                
                          </select>
                        </div>
                    </div>

                    
                </div>

                <div class="row">

                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" 
                          
                      <?php 
                      if(isset($dataRow->name)){
                          ?>
                          value="{{$dataRow->name}}" 
                          <?php 
                      }
                      ?>
                      
                      class="form-control" placeholder="Enter Menu Item Name" id="name" name="name">
                    </div>
                  </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->price)){
                            ?>
                            value="{{$dataRow->price}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Description" id="price" name="price">
                      </div>
                    </div>
   
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Description" id="description" name="description"><?php 
                                if(isset($dataRow->description)){
                                    
                                    echo $dataRow->description;
                                    
                                }
                                ?></textarea>
                      </div>
                    </div>
                </div>
                
                
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Choose Menu Item Image</label>
                            <!-- <label for="customFile">Choose Menu Item Image</label> -->
                            <div class="custom-file">
                              <input type="file" class="custom-file-input"  id="menu_item_image" name="menu_item_image">
                              <input type="hidden" value="{{$dataRow->menu_item_image}}" name="ex_menu_item_image" />
                              <label class="custom-file-label" for="customFile">Choose Menu Item Image</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if(isset($dataRow->menu_item_image))
                            @if(!empty($dataRow->menu_item_image))
                                <img class="img-thumbnail" src="{{url('upload/menuitem/'.$dataRow->menu_item_image)}}" width="150">
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group">
                      <label>Special</label>
                
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"  
                                        <?php 
                                        if($dataRow->special=="Yes"){
                                            ?>
                                            checked="checked" 
                                            <?php 
                                        }
                                        ?>
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
                                            <?php 
                                            if($dataRow->spicy=="Yes"){
                                                ?>
                                                checked="checked" 
                                                <?php 
                                            }
                                            ?>
                                      id="spicy_0" name="spicy" value="Yes">
                                      <label class="form-check-label">Yes</label>
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
              <a class="btn btn-danger" href="{{url('menuitem/edit/'.$dataRow->id)}}">
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
    var SubCategory=<?php echo json_encode($SubCategory); ?>;

    function categoryChange(cid,sid){
      var optionHtml='';
      optionHtml+='<option value="">Please Select</option>';
      $.each(SubCategory,function(key,val){
        if(cid==val.category_id)
        {
            if(sid==val.id)
            {
              optionHtml+='<option selected="selected" value="'+val.id+'">'+val.name+'</option>';
            }
            else
            {
              optionHtml+='<option value="'+val.id+'">'+val.name+'</option>';
            }
            
        }
        
      });
      $("#subcategory").html(optionHtml);
      $("#subcategory").select2();
    }

    $(document).ready(function(){
        $(".select2").select2();

        categoryChange("{{$dataRow->category}}","{{$dataRow->sub_category_id}}");

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
        