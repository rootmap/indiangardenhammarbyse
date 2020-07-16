@extends("admin.layout.master")
@section("title","Edit Reservations Request")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Reservations Request</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('reservationsrequest/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('reservationsrequest/create')}}">Create New </a></li>
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
            <h3 class="card-title">Edit / Modify Reservations Request</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('reservationsrequest/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('reservationsrequest/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('reservationsrequest/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('reservationsrequest/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('reservationsrequest/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
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
                        
                        class="form-control" placeholder="Enter Name" id="name" name="name">
                      </div>
                    </div>
                
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->email)){
                            ?>
                            value="{{$dataRow->email}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Email" id="email" name="email">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="reservations_date">Reservations Date</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->reservations_date)){
                            ?>
                            value="{{$dataRow->reservations_date}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Reservations Date" id="reservations_date" name="reservations_date">
                      </div>
                    </div>
                
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="reservations_time">Reservations Time</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->reservations_time)){
                            ?>
                            value="{{$dataRow->reservations_time}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Reservations Time" id="reservations_time" name="reservations_time">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label>Enter Person Quantity</label>
                                  <select class="form-control select2" style="width: 100%;"  id="person" name="person">
                                    
        <option value="">Please select</option>
            <option 
                    <?php 
                    if($dataRow->person=="1 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="1 person">1 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="2 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="2 person">2 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="3 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="3 person">3 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="4 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="4 person">4 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="5 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="5 person">5 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="6 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="6 person">6 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="7 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="7 person">7 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="8 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="8 person">8 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="9 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="9 person">9 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="10 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="10 person">10 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="11 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="11 person">11 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="12 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="12 person">12 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="13 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="13 person">13 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="14 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="14 person">14 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="15 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="15 person">15 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="16 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="16 person">16 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="17 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="17 person">17 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="18 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="18 person">18 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="19 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="19 person">19 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="20 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="20 person">20 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="21 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="21 person">21 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="22 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="22 person">22 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="23 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="23 person">23 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="24 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="24 person">24 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="25 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="25 person">25< person/option>
            <option 
                    <?php 
                    if($dataRow->person=="26 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="26 person">26 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="27 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="27 person">27 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="28 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="28 person">28 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="29 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="29 person">29 person</option>
            <option 
                    <?php 
                    if($dataRow->person=="30 person"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="30 person">30 person</option>
                                  </select>
                                </div>
                            </div>
                        
            <div class="col-sm-6">
              <!-- radio -->
              <div class="form-group">
              <label>Choose Reservations Status</label>
        
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->reservations_status=="Pending"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="reservations_status_0" name="reservations_status" value="Pending">
                          <label class="form-check-label">Pending</label>
                        </div>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->reservations_status=="Confirmed"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="reservations_status_1" name="reservations_status" value="Confirmed">
                          <label class="form-check-label">Confirmed</label>
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
              <a class="btn btn-danger" href="{{url('reservationsrequest/edit/'.$dataRow->id)}}">
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

@endsection
        