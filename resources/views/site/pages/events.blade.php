@extends('site.layout.master')
@section('title','Events')
@section('content')
<section class="our-story cl-block">
  <div class="container  header-block">
    <div class="row justify-content-center">
      <div class="common_layout_title">
        <h2>{{ $EventPageInfo->page_heading }}</h2>
      </div>
    </div>
  </div>
  <!-- Common Layout Hero -->
  <div class="cl-hero" data-parallax="scroll" style="background-image: url({{URL::asset('upload/eventpageinfo/'.$EventPageInfo->content_background) }});">
    <div class="container">
      <div class="row">
        <div class="col-md-5 col-md-offset-6 block-ded-padd">
          <div class="hero-inner-block">
            <h2>{{ $EventPageInfo->content_heading }}<br>{{ $EventPageInfo->content_sub_heading }}</h2>
            <p>
              {{ $EventPageInfo->content_description }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Common Layout Hero -->

  <!-- Common Layout Body -->
  <div class="cl-body">
    <div class="container">
      @if(!empty($EventInfo))
      <?php 
      $count = 0; 
      
      ?>
      @foreach($EventInfo as $evn)
      <?php
      $oe_style = ++$count % 2 ? "odd" : "even"; 

      if($oe_style=='odd'){
      ?>
        <div class="row parent newhisAr">
          <div class="col-lg-5 col-md-offset-1 visible-sm visible-xs hidden-md hidden-lg nopadd">
            <figure class="dtrFig" style="height: 100%;">
              <img src="{{URL::asset('upload/eventinfo/'.$evn->content_image) }}" style="height: 100%;" alt="Venue" class="img-fluid">
            </figure>
          </div>
          <div class="col-lg-5 col-md-offset-1 nopadd">
            <div class="body-inner-block" style="height: 100%;  display: block;">
              <h2>{{ $evn->heading }}<br>{{ $evn->sub_heading }}</h2>
              <p class="mb-40">
                {{ $evn->content }}
              </p>
              <a href="{{ url('upload/eventinfo/'.$evn->content_attachment) }}" class="btn btn-default btn-inner">Download Floor Plan</a>
            </div>
          </div>
          <div class="col-lg-5 hidden-sm hidden-xs  nopadd">
            <figure class="dtrFig" style="height: 100%;">
              <img src="{{URL::asset('upload/eventinfo/'.$evn->content_image) }}"  style="height: 100%;" alt="Venue" class="img-fluid">
            </figure>
          </div>
        </div>
        <?php 
        }
        else{
          ?>
        <div class="row parent newhisAr">
         <div class="col-lg-5 col-md-offset-1 nopadd">
            <figure class="dtrFig" style="height: 100%;">
              <img src="{{URL::asset('upload/eventinfo/'.$evn->content_image) }}"  style="height: 100%;" alt="Venue" class="img-fluid">
            </figure>
          </div>
          <div class="col-lg-5 nopadd">
            <div class="body-inner-block" style="height: 100%; display: block;">
              <h2>{{ $evn->heading }}<br>{{ $evn->sub_heading }}</h2>
              <p class="mb-40">
                {{ $evn->content }}
              </p>
              <a href="{{ url('upload/eventinfo/'.$evn->content_attachment) }}" class="btn btn-default btn-inner">Download Floor Plan</a>
            </div>
          </div>
        </div>
        <?php
        }
      ?>
      @endforeach
      @endif
    </div>
  </div>
  <!-- /Common Layout Body -->
</section>
@endsection

@section('css')
<style type="text/css">
  .parent {
    display: flex;
}

</style>
@endsection

@section('js')
<script type="text/javascript">

  var isMobile = {
              Android: function() {
                  return navigator.userAgent.match(/Android/i);
              },
              BlackBerry: function() {
                  return navigator.userAgent.match(/BlackBerry/i);
              },
              iOS: function() {
                  return navigator.userAgent.match(/iPhone|iPad|iPod/i);
              },
              Opera: function() {
                  return navigator.userAgent.match(/Opera Mini/i);
              },
              Windows: function() {
                  return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
              },
              any: function() {
                  return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
              }
          };

          if( isMobile.any() )
          { 
            $('.newhisAr').removeClass('parent');
          }
          else
          {
            $('.newhisAr').addClass('parent');

            $('.newhisAr').each(function(){
                //$(this).find('.body-inner-block').css('height',$(this).find('.dtrFig').children('img').height());
            });
          }

        
</script>
@endsection