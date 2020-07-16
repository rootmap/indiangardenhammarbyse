<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('dashboard')}}" class="brand-link">
      <img src="{{ url('admin/dist/img/AdminLTELogo.png') }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link {{ Request::path() == 'dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('slider','weareopen','homepagevideo','homeorderdelivery','homedelivery'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('slider','weareopen','homepagevideo','homeorderdelivery','homedelivery'))?'active':'' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home Page
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('slider')}}" class="nav-link {{ Request::path() == 'slider' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('weareopen')}}" class="nav-link {{ Request::path() == 'weareopen' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>We are open</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('homepagevideo')}}" class="nav-link {{ Request::path() == 'homepagevideo' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Video</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('homeorderdelivery')}}" class="nav-link {{ Request::path() == 'homeorderdelivery' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order Delivery</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('homedelivery')}}" class="nav-link {{ Request::path() == 'homedelivery' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delivery</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('ourhistorypageinfo','ourhistory'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('ourhistorypageinfo','ourhistory'))?'active':'' }}">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Our History
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('ourhistorypageinfo')}}" class="nav-link {{ Request::path() == 'ourhistorypageinfo' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Our History Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('ourhistory')}}" class="nav-link {{ Request::path() == 'ourhistory' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Our History</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('menupageinfo','category','menuitem'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('menupageinfo','category','menuitem'))?'active':'' }}">
              <i class="nav-icon fas fa-utensils"></i>
              <p>
                Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('menupageinfo')}}" class="nav-link {{ Request::path() == 'menupageinfo' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu Page Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('category')}}" class="nav-link {{ Request::path() == 'category' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('subcategory')}}" class="nav-link {{ Request::path() == 'subcategory' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('menuitem')}}" class="nav-link {{ Request::path() == 'menuitem' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Our Menu</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('eventpageinfo','eventinfo'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('eventpageinfo','eventinfo'))?'active':'' }}">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Events
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('eventpageinfo')}}" class="nav-link {{ Request::path() == 'eventpageinfo' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Event Page Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('eventinfo')}}" class="nav-link {{ Request::path() == 'eventinfo' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Events</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('galleryphoto','gallerycategory'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('galleryphoto','gallerycategory'))?'active':'' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Gallery
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('gallerycategory')}}" class="nav-link {{ Request::path() == 'gallerycategory' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('galleryphoto')}}" class="nav-link {{ Request::path() == 'galleryphoto' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gallery</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview {{ in_array(Request::path(),array('reservationsrequest','reservation-contact'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('reservationsrequest','reservation-contact'))?'active':'' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Reservation & Contact
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('reservation-contact')}}" class="nav-link {{ Request::path() == 'reservation-contact' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reservation Page Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('reservationsrequest')}}" class="nav-link {{ Request::path() == 'reservationsrequest' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reservation Request</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{url('contactusrequest')}}" class="nav-link {{ Request::path() == 'contactusrequest' ? 'active' : '' }}">
              <i class="nav-icon fas fa-phone-square-alt"></i>
              <p>Contact</p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('sitesettings','openinghour','sociallinkmgt/create','websitesettings/create'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('sitesettings','openinghour','sociallinkmgt/create','websitesettings/create'))?'active':'' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('sitesettings')}}" class="nav-link {{ Request::path() == 'sitesettings' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Site Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('openinghour')}}" class="nav-link {{ Request::path() == 'openinghour' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Opening Hour</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('sociallinkmgt/create')}}" class="nav-link {{ Request::path() == 'sociallinkmgt/create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Social Media Link</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('websitesettings/create')}}" class="nav-link {{ Request::path() == 'websitesettings/create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Seo Setting</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    {{-- ============================================ --}}
    <div class="side-bar-bottom">
        <ul class="list-unstyled">
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Edit Profile"><a
              href="#"><i class="fas fa-cog"></i></a></li>
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Change Password"><a
              href="#"><i class="fas fa-key"></i></li>
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Lockscreen"><a
              href="#"><i class="fas fa-unlock"></i></a></li>
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Logout">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
          </li>
        </ul>
      </div><!-- End side-bar-bottom -->
  </aside>

  <style type="text/css">
    .side-bar-bottom {
      width: 100%;
      height: 35px;
      background-color: #343a40;
      position: -webkit-sticky;
      position: sticky;
      bottom: 0px;
      margin-top: 93%;
      color: #cccccc;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      border-top: 2px solid #444a50;
      padding-top: 25px;
      /*-webkit-box-shadow: 0px 2px 5px 5px black;
      box-shadow: 0px 2px 5px 5px black;*/
  }
  .side-bar-bottom ul li a i{
    color: #fff;
    padding: 10px;
  }
  </style>