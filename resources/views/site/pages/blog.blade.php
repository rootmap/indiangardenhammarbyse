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
        <h2>Blog</h2>
      </div>
    </div>
  </div>
  <!--===| Gallery Us Banner End|===-->

  <!--====| Shuffle Gallery Style Sta rt|====--> 
  <section class="menus">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="col-md-4 mb-1">
            <a href="#">
              <div class="blog-block">
                <div class="blog">
                  <img style="max-height:230px;" src="{{ url('site/img/blog/1.webp') }}" alt="MEXICAN GRILLED CORN">
                </div>
                <div class="blog-text">
                  <div class="avatar_image">
                    <div class="avatar-image">
                     <img style="max-height:230px;" src="{{ url('site/img/blog/unnamed.jpg') }}" alt="avatar image">
                   </div>
                   <div class="_2wbeQ">
                    <a href="#" class="_25KXg">
                      <span class="_2MJF1 user-name _1Gv8s blog-post-homepage-description-color blog-post-homepage-description-font blog-post-homepage-link-hashtag-hover-color" data-hook="user-name">K.S. Fahim</span>
                      <div aria-label="Admin" data-hook="badge" class="Cu6fU">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" viewBox="0 0 19 19" class="blog-post-homepage-description-fill" style="fill-rule: evenodd;">
                          <path d="M15.3812,6.495914 L12.6789333,8.77258837 C12.6191333,8.84477644 12.5099333,8.85722265 12.4354,8.79997005 C12.4215333,8.79001308 12.4094,8.77756686 12.3998667,8.76429089 L9.78686667,6.14327115 C9.67766667,5.99225704 9.46186667,5.95491839 9.305,6.05863687 C9.26946667,6.08186981 9.23913333,6.11091099 9.21573333,6.14493065 L6.60013333,8.81075677 C6.5464,8.88626383 6.43893333,8.90534803 6.3592,8.85390366 C6.34446667,8.84394669 6.33146667,8.83233022 6.32106667,8.81905425 L3.61966667,6.50587098 C3.5018,6.36149485 3.28426667,6.33577266 3.13346667,6.44861837 C3.0494,6.51167921 3,6.60792997 3,6.70998895 L4,14 L15,14 L16,6.70169148 C16,6.51831719 15.8448667,6.36979232 15.6533333,6.36979232 C15.5476,6.36979232 15.4470667,6.41625821 15.3812,6.495914 Z"></path>
                        </svg>
                      </div>
                    </a>
                    <ul class="_1ReRx blog-post-homepage-description-font blog-post-homepage-description-color _2qkGq">
                      <li><span class="post-metadata__date time-ago" data-hook="time-ago">Feb 3</span></li>
                      <li><div class="_2yYN5 e8kGb blog-post-homepage-description-background-color"></div></li>
                      <li><span class="post-metadata__readTime" data-hook="time-to-read">1 min</span></li>
                    </ul>
                  </div>
                </div>
                <h3>MEXICAN GRILLED CORN</h3>
                <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,....</p>
                {{-- <a href="#" class="btn btn-info">Read more</a> --}}
                <hr/>
                <div class="clearfix"></div>
                <div class="blog_icon">
                  <i class="fa fa-eye"></i> <span>7</span> 
                  <i class="fa fa-comments"></i> <span>1</span> 
                  <i class="fa fa-heart" style="float: right; color: red"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-4 mb-1">
          <div class="blog-block">
            <div class="blog">
              <img style="height:230px;" src="{{ url('site/img/custom/menu/menus2.jpg') }}" alt="MEXICAN GRILLED CORN">
            </div>
            <div class="blog-text">
              <h3>MEXICAN GRILLED CORN</h3>
              <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,....</p>
              <a href="#" class="btn btn-info">Read more</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-1">
          <div class="blog-block">
            <div class="blog">
              <img style="height:230px;" src="{{ url('site/img/custom/menu/menus3.jpg') }}" alt="MEXICAN GRILLED CORN">
            </div>
            <div class="blog-text">
              <h3>MEXICAN GRILLED CORN</h3>
              <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,....</p>
              <a href="#" class="btn btn-info">Read more</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-1">
        <div class="blog-block">
          <div class="blog">
            <img style="height:230px;" src="{{ url('site/img/blog/1.webp') }}" alt="MEXICAN GRILLED CORN">
          </div>
          <div class="blog-text">
            <h3>MEXICAN GRILLED CORN</h3>
            <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,....</p>
            <a href="#" class="btn btn-info">Read more</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-1">
        <div class="blog-block">
          <div class="blog">
            <img style="height:230px;" src="{{ url('site/img/custom/menu/menus2.jpg') }}" alt="MEXICAN GRILLED CORN">
          </div>
          <div class="blog-text">
            <h3>MEXICAN GRILLED CORN</h3>
            <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,....</p>
            <a href="#" class="btn btn-info">Read more</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-1">
        <div class="blog-block">
          <div class="blog">
            <img style="height:230px;" src="{{ url('site/img/custom/menu/menus3.jpg') }}" alt="MEXICAN GRILLED CORN">
          </div>
          <div class="blog-text">
            <h3>MEXICAN GRILLED CORN</h3>
            <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,....</p>
            <a href="#" class="btn btn-info">Read more</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-1">
        <div class="blog-block">
          <div class="blog">
            <img style="height:230px;" src="{{ url('site/img/custom/menu/menus4.jpg') }}" alt="MEXICAN GRILLED CORN">
          </div>
          <div class="blog-text">
            <h3>MEXICAN GRILLED CORN</h3>
            <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,....</p>
            <a href="#" class="btn btn-info">Read more</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-1">
        <div class="blog-block">
          <div class="blog">
            <img style="height:230px;" src="{{ url('site/img/custom/menu/menus5.jpg') }}" alt="MEXICAN GRILLED CORN">
          </div>
          <div class="blog-text">
            <h3>MEXICAN GRILLED CORN</h3>
            <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,....</p>
            <a href="#" class="btn btn-info">Read more</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-1">
        <div class="blog-block">
          <div class="blog">
            <img style="height:230px;" src="{{ url('site/img/custom/menu/menus6.jpg') }}" alt="MEXICAN GRILLED CORN">
          </div>
          <div class="blog-text">
            <h3>MEXICAN GRILLED CORN</h3>
            <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,....</p>
            <a href="#" class="btn btn-info">Read more</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-1">
        <div class="blog-block">
          <div class="blog">
            <img style="height:230px;" src="{{ url('site/img/custom/menu/menus7.jpg') }}" alt="MEXICAN GRILLED CORN">
          </div>
          <div class="blog-text">
            <h3>MEXICAN GRILLED CORN</h3>
            <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,....</p>
            <a href="#" class="btn btn-info">Read more</a>
          </div>
        </div>
      </div>
    </div>
  </div><!-- row -->
</div><!-- container -->
</section> 
<!--====| Shuffle Gallery Style End |====-->
@endsection