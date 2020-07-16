<header class="header-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-xs-12">
            <div class="logo">
               <a title="digimo" href="{{ url('index') }}">
                  <img id="logo"  style="height: 56px;
    margin-top: 3px;"  src="{{URL::asset('upload/sitesettings/'.$social->site_logo) }}" alt="{{ $social->site_title }}">
               </a>
            </div>
            <!-- /Logo -->
            <!-- =========================================
               Men4u
               ========================================== -->
            <div class="navbar navbar-default mainnav">
               <div class="navbar-header navbar-right pull-right">
                  <div id="offcanvas-trigger-effects" class="column">
                     <button type="button" class="navbar-toggle visible-sm visible-xs" data-toggle="offcanvas" data-target=".navbar-collapse" data-placement="right" data-effect="offcanvas-effect"> <i class="fa fa-bars"></i>
                     </button>
                  </div>
                  <!-- offcanvas-trigger-effects -->
               </div>
               <!-- .navbar-header -->
               <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav navbar-right">
                     <!-- <li class="active"><a href="index.php">Home</a></li> -->
                     @if($pageInfo->ourstory_status=='Active')
                     <li class="{{ Request::path() == 'our-story' ? 'active' : '' }}"><a href="{{ url('our-story') }}">Our Story</a></li>
                     @endif
                     <li class="{{ Request::path() == 'menu' ? 'active' : '' }}"><a href="{{ url('menu') }}">Menu</a></li>
                     <li class="{{ Request::path() == 'events' ? 'active' : '' }}"><a href="{{ url('events') }}">Events </a></li>
                     <li class="{{ Request::path() == 'gallery' ? 'active' : '' }}"><a href="{{ url('gallery') }}">Gallery </a></li>
                     {{-- <li class="{{ Request::path() == 'blog' ? 'active' : '' }}"><a href="{{ url('blog') }}">Blog </a></li> --}}
                     @if($pageInfo->reservations_status=='Active')
                     <li class="{{ Request::path() == 'reservation' ? 'active' : '' }}"><a href="{{ url('reservation') }}">Reservation & Contact</a></li>
                     @endif
                  </ul>
                  <!-- .navbar-nav -->
               </div>
               <!-- .navbar-collapse -->
            </div>
            <!-- .navbar -->
         </div>
         <!-- .col-xs-12 -->
      </div>
      <!-- .row -->
   </div>
   <!-- .container -->
</header>