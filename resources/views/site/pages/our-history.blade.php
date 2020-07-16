@extends('site.layout.master')
@section('title','Our Story')
@section('content')
<section class="our-story cl-block">
  <div class="container  header-block">
    <div class="row justify-content-center">
      <div class="common_layout_title">
        <h2>{{$history[0]->page_heading}}</h2>
      </div>
    </div>
  </div>
  <!-- Common Layout Hero -->
  <div class="cl-hero" data-parallax="scroll" style="background-image: url({{URL::asset('upload/ourhistorypageinfo/'.$history[0]->background_image) }});">
    <div class="container">
      <div class="row">
        <div class="col-md-5 col-md-offset-6 block-ded-padd">
          <div class="hero-inner-block">
            <h2><?= html_entity_decode($history[0]->content_heading)?></h2>
            <p>
              {{$history[0]->content_description}}
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
      @if(!empty($OurHistory))
      <?php 
      $count = 0; 
      
      ?>
      @foreach($OurHistory as $his)
      <?php
      $oe_style = ++$count % 2 ? "odd" : "even"; 

      if($oe_style=='odd'){
      ?>
      <div class="row newhisAr">
        <div class="col-lg-5 col-lg-offset-1 nopadd">
          <figure class="dtrFig">
            <img src="{{URL::asset('upload/ourhistory/'.$his->content_image) }}" alt="{{ $his->heading }}" class="img-fit">
          </figure>
        </div>
        <div class="col-lg-5  nopadd">
          <div class="body-inner-block">
            <h2>{{ $his->heading }}<br>{{ $his->sub_heading }}</h2>
            <p class="mb-40">
              {{ $his->content_detail }}
            </p>
          </div>
        </div>
      </div>
      <?php 
      }
      else
      {
      ?>
          <div class="row newhisAr">
            <div class="col-lg-5 col-lg-offset-1 nopadd">
              <div class="body-inner-block">
                <h2>{{ $his->heading }}<br>{{ $his->sub_heading }}</h2>
            <p class="mb-40">
              {{ $his->content_detail }}
            </p>
              </div>
            </div>
            <div class="col-lg-5 nopadd">
              <figure class="dtrFig">
                <img src="{{URL::asset('upload/ourhistory/'.$his->content_image) }}" alt="{{ $his->heading }}" class="img-fit">
              </figure>
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

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('.newhisAr').each(function(){
            $(this).find('.body-inner-block').css('height',$(this).find('.dtrFig').children('img').height());
        });
    });
</script>
@endsection