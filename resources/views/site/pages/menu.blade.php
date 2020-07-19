@extends('site.layout.master')
@section('title','Menu')
@section('css')
 <link href="https://fonts.googleapis.com/css?family=Roboto:500&display=swap" rel="stylesheet">
@endsection
@section('js')
<script type="text/javascript">
    var SubCategory = <?php echo json_encode($SubCategory); ?>;
    var nMenu = <?php echo json_encode($nMenu); ?>;
    var menu_cat_id = {{$category?$category[0]->id:'1' }};

    function subcatLoad(menu_cat_id){
        $('.top-menu-cat').removeClass('top-menu-cat-active');
        $('#top-menu-cat-'+menu_cat_id).addClass('top-menu-cat-active');

        $(".mobmenu").fadeOut('fast');
        $(".mobmenu_"+menu_cat_id).fadeIn('slow');

        var list_menu='';
        var k=1;
        $.each(SubCategory,function(key,row){
            if(row.category_id==menu_cat_id)
            {

                var menuNames=$.trim(row.name);
                    menuNames=menuNames.replace(' ','');
                    menuNames=menuNames.replace(' ','');
                    menuNames=menuNames.replace(' ','');
                    menuNames=menuNames.replace(' ','');
                    menuNames=menuNames.replace(' ','');
                    menuNames=menuNames.replace(' ','');
                    menuNames=menuNames.replace('&','');
                console.log('menuNames',menuNames);
                list_menu+='<li class="">';
                if(k==1)
                {
                    list_menu+='   <a href="javascript:void(0);" data-category="'+row.category_id+'" data-sub-category="'+row.id+'" data-group="'+menuNames+'" class="active menuitemLoad first_item">';
                }
                else
                {
                    list_menu+='   <a href="javascript:void(0);" data-category="'+row.category_id+'" data-sub-category="'+row.id+'"  data-group="'+menuNames+'" class="menuitemLoad">';
                }
                list_menu+=row.name;
                list_menu+='   </a>';
                list_menu+='</li>';
                k++;
            }
            
        });
        //console.log(list_menu);
        $("#subcatlist").html(list_menu);

        $('.first_item').trigger('click');
    }

    subcatLoad(menu_cat_id);
    $(document).ready(function(){

        //subcatlist
        
        $('.all-item').fadeOut('fast');
        $('.{{ count($category)>0?$category[0]->name:'Menu' }}').fadeIn('fast');

        $('body').on('click', '.menuitemLoad', function() {
        //$('.menuitemLoad').click(function(){

            var itemClass=$(this).attr('data-group');
            //alert(itemClass);
            var menuText=$(this).html();

            var category=$(this).attr('data-category');
            var sub_category=$(this).attr('data-sub-category');
            
            $('.common_layout_title h2').html(menuText);

            $('.all-item').fadeOut('slow');
            $('.'+itemClass).fadeIn('fast');
            $('.menuitemLoad').removeClass('active');
            $(this).addClass('active');

            console.log('category',category);
            console.log('sub_category',sub_category);

            var menuHtml='';
            var kk=1;
            var kkk=1;
            var total_kk=1;
            $.each(nMenu,function(key,row){
                if(category==row.category && sub_category==row.sub_category_id)
                {
                    total_kk++;
                }
            });
            $.each(nMenu,function(key,row){
                if(category==row.category && sub_category==row.sub_category_id)
                {
                    console.log(row);

                     if(kk==1)
                     {
                        menuHtml+='<div class="row">';
                     }
                     menuHtml+='<div class="col-md-6 item-box mb-1 all-item Menu" style="display: block;">';
                     menuHtml+='   <h4 class="item-title">';
                     menuHtml+='      <span>'+row.name+'</span>';
                     menuHtml+='   </h4>';
                     menuHtml+='   <span class="menu-item-price uppercase">'+row.price+'</span>';
                     menuHtml+='   <div class="item-description">';
                     menuHtml+='       <p>'+row.description+'</p>';            
                     menuHtml+='   </div>';
                     menuHtml+='</div>';
                     if(kk==2)
                     {
                        menuHtml+='</div>';
                        kk=0;
                     }

                     if(kk==1 && kkk==total_kk)
                     {
                        menuHtml+='</div>';
                     }
                     kk++;
                }

                
            });

            $("#menuItemShow").html(menuHtml);

            //menuItemShow

        
        });

        //$('.mob-cat-menu').click(function(){
        $('body').on('click', '.mob-cat-menu', function() {
            $('.mob-cat-menu').children('i').removeClass('fa fa-caret-down');
            $('.mob-cat-menu').children('i').addClass('fa fa-caret-right');
            if($(this).hasClass('active'))
            {
                $('.all-item').fadeOut('slow');
                $(this).removeClass('active');

                $(this).children('i').removeClass('fa fa-caret-down');
                $(this).children('i').addClass('fa fa-caret-right');
                
            }
            else
            {
                $(this).addClass('active');

                $(this).children('i').removeClass('fa fa-caret-right');
                $(this).children('i').addClass('fa fa-caret-down');

                var catID=$(this).attr('data-cat');
                var menuName=$(this).attr('data-heading');

                $('.common_layout_title h2').html(menuName);

                $('.all-item').fadeOut('slow');
                $('.'+catID).fadeIn('fast');
            }

            
        });

        $('.first_item').trigger('click');
    });
</script>
@endsection
@section('content')
<style type="text/css">
        .top-menu-cat {

            -moz-box-shadow:inset 0px 39px 0px -24px #907f47;
            -webkit-box-shadow:inset 0px 39px 0px -24px #907f47;
            box-shadow:inset 0px 39px 0px -24px #907f47;
            background-color:#948143;
            -webkit-border-top-left-radius:8px;
            -moz-border-radius-topleft:8px;
            border-top-left-radius:8px;
            -webkit-border-top-right-radius:8px;
            -moz-border-radius-topright:8px;
            border-top-right-radius:8px;
            -webkit-border-bottom-right-radius:0px;
            -moz-border-radius-bottomright:0px;
            border-bottom-right-radius:0px;
            -webkit-border-bottom-left-radius:0px;
            -moz-border-radius-bottomleft:0px;
            border-bottom-left-radius:0px;
            text-indent:0;
            border:1px solid #ffffff;
            display:inline-block;
            color:#ffffff;
            font-family:arial;
            font-size:15px;
            font-weight:bold;
            font-style:normal;
            height:34px;
            line-height:34px;
            text-decoration:none;
            text-align:center;
            text-shadow:0px 1px 0px #b23e35;
            padding-left: 15px; 
            padding-right: 15px;
        }
        .top-menu-cat:hover {
            background-color:#907f47;
        }
        .top-menu-cat:active {
            position:relative;
            top:1px;
            
        }

        .top-menu-cat-active
        {
            opacity: 0.80;
        }
</style>
  <div class="container header-block">
    <div class="row justify-content-center cl-block">
      <div class="common_layout_title">
        <h2>{{count($category)>0?$category[0]->name:'Menu' }}</h2>
      </div>
    </div>
    <div class="container">
        <div class="col-md-8 col-sm-12 col-xs-12">
            @if(isset($category))
                <?php 
                    $m=1;
                ?>
                @foreach($category as $cat)
                    <a href="javascript:subcatLoad({{$cat->id}});" id="top-menu-cat-{{$cat->id}}" class="top-menu-cat{{$m==1?' top-menu-cat-active':''}}"> {{$cat->name}}</a>
                    <?php 
                        $m++;
                    ?>
                @endforeach
            @endif
           
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12 hidden-xs hidden-sm">
            <a href="{{url('upload/menupageinfo/'.$MenuPageInfo[0]->download_lunch_menu)}}" target="_blank" class="top-menu-cat pull-right"><i class="fa fa-file-text"></i> Download Lunch Menu</a>
        </div>
    </div>
  </div>
<!--===| Menu Page Top Banner End |===-->
<style type="text/css">
   
    .menu_side_bar
    {
        border-right: 2px #5f0038 solid;
        min-height: 500px;
    }

    .menu-cat
    {
        font-size: 1.2rem;
        font-family: 'Roboto', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-cat > li
    {
        height: 50px;
        padding: 0 40px 0 20px;
        line-height: 65px;
        min-width: 150px;
        font-size: 1.2rem !important;
    }
    .data-cat > li > a
    {
            font-size: 17px !important;
            font-family: 'Roboto', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px !important;
            color:#5f0038;
            font-weight: 600;
            opacity: 80%;
    }

    .data-cat > li > .active
    {
            color:#5f0038;
            opacity: 100%;
            border-bottom: 2px #5f0038 solid;
    }

    .data-cat > li > a:hover
    {
            color:#5f0038;
            opacity: 100%;
            border-bottom: 2px #5f0038 solid;
    }

    

    .item-box
    {

    }

    .item-box > .item-title
    {
        line-height: 35px;
        display: block;
    }
    .item-box > .item-title > span
    {
        line-height: 35px;
        font-size: 16px;
        font-family: 'Roboto', sans-serif;
        font-weight: 700;
        color: #5f0038;
        opacity: 90%;
        display: block;
    }

    .item-box > .menu-item-price {
        color: #161616;
        font-family: 'Roboto', sans-serif;
        font-size:18px;
        margin: 0;
        display: block;
        font-weight: 500;
    }
    .item-box > .item-description {
        color: #161616;
        font-family: 'Roboto', sans-serif;
        font-size:14px;
        margin: 0;
        display: block;
        font-weight: 400;
    }

    .mob-cat-menu
    {
      text-decoration: none;
        font-size: 25px;
        font-weight: 500;
        font-family: 'Roboto', sans-serif;
        /* text-decoration: underline; */
        display: block;
        width: 100%;
        color:#5f0038;
        border-bottom: 1px #5f0038 inset;
        border-width: 70%;
        line-height: 40px;
        padding-bottom: 5px;
        margin-bottom: 10px;
        cursor: pointer;
    }

    
    
</style>
<!--===| Menu Page First Block Start |===-->
<section class="menus" style="background: #f2f0ed;">
  <div class="container">
      <div class="row hidden-sm hidden-xs">
          <div class="col-md-4 menu_side_bar">
              <ul class="list-group data-cat" id="subcatlist">
              @if(isset($category))
                <?php $i=0; ?>
                @foreach($category as $c)
                   <li class="">
                      <a href="javascript:void(0);" data-group="{{ str_replace('&','',str_replace(' ','',$c->name)) }}" class="{{$i==0?'active':''}} menuitemLoad">
                        {{$c->name}}
                      </a>
                    </li>
                    <?php $i++; ?>
                @endforeach
              @endif
              </ul>
          </div>
          <div class="col-md-8" id="menuItemShow">
              
            <h4 class="item-title">
                <span>Loading Please Wait...</span>
            </h4>
                  
              
          </div>

      </div>
      
      <div class="row hidden-md hidden-lg">
          <div class="col-md-12">
              
                  @if(isset($MenuItem))
                      @foreach($MenuItem as $m)

                          <div class="row mobmenu_{{$m['cid']}} mobmenu">
                            <div class="col-md-12">
                                <h3 data-heading="{{str_replace('&','',$m['name'])}}" data-cat="intcat{{$m['id']}}" class="mob-cat-menu"><i class="fa fa-caret-right"></i> {{$m['name']}} <span>&nbsp;</span></h3>
                            </div>
                          </div> 

                          @if(count($m['scat'])>0)
                              <?php $M=0; $k=0; ?>
                              @foreach($m['scat'] as $r)
                                  @if($M==0)
                                    <div class="row all-item {{'intcat'.$m['id']}}">
                                  @endif
                                  <div class="col-md-6 item-box mb-1 {{'intcat'.$m['id']}} all-item {{ str_replace('&','',str_replace(' ','',$m['name'])) }}">
                                      <h4 class="item-title">
                                          <span>{{ $r['name'] }}</span>
                                      </h4>
                                      <span class="menu-item-price uppercase">{{ $r['price'] }}</span>
                                      <div class="item-description">
                                          <p>{{ $r['description'] }}</p>            
                                      </div>
                                  </div>
                                  <?php 
                                  $M++; 
                                  $k++;

                                  if($k==count($m['scat']))
                                  {
                                    ?>
                                    </div>
                                    <?php 
                                  }
                                  elseif($M==2){
                                    $M=0;
                                    ?>
                                    </div>
                                    <?php 
                                  }
                                  ?>
                              @endforeach
                          @endif
                      @endforeach
                  @endif
                  
              
          </div>
          
      </div>
  </div>
</section>
<!--===| Menu Page First Block End |===-->
@endsection