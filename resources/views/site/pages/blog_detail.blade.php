@extends('site.layout.master')
@section('title','Blog')
@section('content')

<!--===| Gallery Banner Start|===-->
  {{-- <section class="gallery-banner" style="background-image: url({{ url('site/img/custom/our-story-hero.jpg') }});">
    <div class="control-overlay">
      <div class="banner-wrapper control-overlay">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <h1>gallery</h1>
                <p>fresh and healthy food available</p>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section> --}}
  <div class="container header-block">
    <div class="row justify-content-center cl-block">
      <div class="common_layout_title">
        <h2>Blog Details</h2>
      </div>
    </div>
  </div>
  <!--===| Gallery Us Banner End|===-->
 
  <!--====| Shuffle Gallery Style Sta rt|====--> 
  <section class="menus">
    <div class="container">
      <div class="row"> 
        <div class="col-md-12 mb-1">
          <div class="blog-block">
            <div class="blog">
              <img src="{{ url('site/img/custom/menu/menus1.jpg') }}" alt="MEXICAN GRILLED CORN">
            </div>
            <div class="blog-text">
              <h3>MEXICAN GRILLED CORN</h3>
              <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- row -->
  </div><!-- container -->
</section> 
<!--====| Shuffle Gallery Style End |====-->
@endsection