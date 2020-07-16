@extends('site.layout.master')
@section('title','Menu')
@section('css')
 <link href="https://fonts.googleapis.com/css?family=Roboto:500&display=swap" rel="stylesheet">
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        

        $('.all-item').fadeOut('fast');
        $('.{{ count($category)>0?$category[0]->name:'Menu' }}').fadeIn('fast');

        $('.menuitemLoad').click(function(){
            var itemClass=$(this).attr('data-group');

            var menuText=$(this).html();
            $('.common_layout_title h2').html(menuText);

            $('.all-item').fadeOut('slow');
            $('.'+itemClass).fadeIn('fast');
            $('.menuitemLoad').removeClass('active');
            $(this).addClass('active');
        
        });

        $('.mob-cat-menu').click(function(){

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
    });
</script>
@endsection
@section('content')
  
<!--===| Menu Page Top Banner Start |menu-banner===-->
  <div class="container header-block">
    <div class="row justify-content-center cl-block">
      <div class="common_layout_title">
        <h2>{{ count($category)>0?$category[0]->name:'Menu' }}</h2>
      </div>
    </div>
    <div class="container">
        <div class="col-md-4">
            <a href="{{url('upload/menupageinfo/'.$MenuPageInfo[0]->download_lunch_menu)}}" target="_blank" class="btn btn-info"><i class="fa fa-file-text"></i> Download Lunch Menu</a>
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
              <ul class="list-group data-cat">
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
          <div class="col-md-8">
              
                  @if(isset($MenuItem))
                      @foreach($MenuItem as $m)
                          @if(count($m['scat'])>0)
                              <?php $M=0; $k=0; ?>
                              @foreach($m['scat'] as $r)
                                  @if($M==0)
                                    <div class="row">
                                  @endif
                                  <div class="col-md-6 item-box mb-1 all-item {{ str_replace('&','',str_replace(' ','',$m['name'])) }}">
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
      
      <div class="row hidden-md hidden-lg">
          <div class="col-md-12">
              
                  @if(isset($MenuItem))
                      @foreach($MenuItem as $m)

                          <div class="row">
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