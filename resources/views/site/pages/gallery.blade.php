@extends('site.layout.master')
@section('title','Gallery')
@section('content')

<!--===| Gallery Banner Start|===-->
 
  <div class="container header-block">
    <div class="row justify-content-center cl-block">
      <div class="common_layout_title">
        <h2>Gallery</h2>
      </div>
    </div>
  </div>
  <!--===| Gallery Us Banner End|===-->


    <section id="gallery">
  <div class="container">
    <div class="row">
      <div class="gallery-trigger">
          <ul id="filter">
             <li><a class="active loadGalleryFilter" href="#" data-group="allcat">all</a></li> 
             @if(count($category)>0)
                @foreach($category as $c)
                  <li>
                    <a href="javascript:void(0);" class="loadGalleryFilter" data-group="{{ str_replace(' ','',$c->name) }}">
                      {{ $c->name }}
                    </a>
                  </li> 
                @endforeach
             @endif
          </ul> 
      </div>
    </div>
    <div id="image-gallery">
      <div class="row" style="padding-bottom: 45px;">
        @if(count($gallery)>0)
            @foreach($gallery as $g)
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 image allcat {{ str_replace(' ','',$g->category_name) }}" style="padding-right: 0px; padding-left: 5px;">
                  <div class="img-wrapper zoom-gallery">
                    <a href="{{url('upload/gallery/'.$g->gallery_image)}}">
                      <img class="open-popup"  src="{{url('upload/gallery/small/'.$g->gallery_image)}}" class="img-responsive">
                    </a>
                    <div class="img-overlay"  data-src="">
                      <i style="color: #fff;" class="fa fa-search-plus" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
            @endforeach
        @endif
        
        
        
      </div><!-- End row -->
      <div class="row">
          {{ $gallery->links() }}
      </div>
    </div><!-- End image gallery -->

       
  </div><!-- End container --> 
</section>


  @endsection

  @section('css')
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
  <style type="text/css">

      #gallery {
        padding-top: 40px;
        @media screen and (min-width: 991px) {
          padding: 60px 30px 0 30px;
        }
      }

      .img-wrapper {
        position: relative;
        margin-top: 5px;
        img {
          width: 100%;
        }
      }
      .img-overlay {
        background: rgba(0,0,0,0.7);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        i {
          color: #fff;
          font-size: 3em;
        }
      }

      #overlay {
        background: rgba(0,0,0,0.7);
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
        // Removes blue highlight
        -webkit-user-select: none;
        -moz-user-select: none;    
        -ms-user-select: none; 
        user-select: none; 
        img {
          margin: 0;
          width: 70%;
          height: auto;
          object-fit: contain;
          padding: 5%;
          @media screen and (min-width:768px) {
              width: 60%;
          }
          @media screen and (min-width:1200px) {
              width: 50%;
          }
        }
      }


      .image-source-link {
        color: #98C3D1;
      }

      .mfp-with-zoom .mfp-container,
      .mfp-with-zoom.mfp-bg {
        opacity: 0;
        -webkit-backface-visibility: hidden;
        /* ideally, transition speed should match zoom duration */
        -webkit-transition: all 0.3s ease-out; 
        -moz-transition: all 0.3s ease-out; 
        -o-transition: all 0.3s ease-out; 
        transition: all 0.3s ease-out;
      }

      .mfp-with-zoom.mfp-ready .mfp-container {
          opacity: 1;
      }
      .mfp-with-zoom.mfp-ready.mfp-bg {
          opacity: 0.8;
      }

      .mfp-with-zoom.mfp-removing .mfp-container, 
      .mfp-with-zoom.mfp-removing.mfp-bg {
        opacity: 0;
      }

      
  </style>
  @endsection
  @section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
  <script type="text/javascript">
      // Gallery image hover

    $(document).ready(function(){

        $(".loadGalleryFilter").click(function(){
            var dtg=$(this).attr('data-group');
            $('.allcat').hide();
            $('.'+dtg).fadeIn(800);
        });
    });


    $( ".img-wrapper" ).hover(
      function() {
        $(this).find(".img-overlay").animate({opacity: 1}, 600);
      }, function() {
        $(this).find(".img-overlay").animate({opacity: 0}, 600);
      }
    );

    $('.img-overlay').click(function(){
        $(this).parent().children('a').click();
    });


    $(document).ready(function() {
      $('.zoom-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        image: {
          verticalFit: true
          /*titleSrc: function(item) {
            return item.el.attr('title');
          }*/
        },
        gallery: {
          enabled: true
        },
        zoom: {
          enabled: true,
          duration: 300, // don't foget to change the duration also in CSS
          opener: function(element) {
            return element.find('img');
          }
        }
        
      });
    });

    
    
  </script>
@endsection