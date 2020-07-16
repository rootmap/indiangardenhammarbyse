<!--==| offcanvas-menu |==-->
<div class="offcanvas-menu offcanvas-effect  hidden-sm hidden-md hidden-lg">
  <button id="off-canvas-close-btn" class="close" type="button" aria-hidden="true" data-toggle="offcanvas" >&times;</button>
  <h2>Sidebar Menu</h2>
  <ul>
   <li><a href="{{url('index')}}">Home</a></li>
   @if($pageInfo->ourstory_status=='Active')
   <li ><a href="{{ url('our-story') }}">Our Story</a></li>
   @endif
   
   <li ><a href="{{ url('menu') }}">Menu</a></li>
   <li><a href="{{ url('events') }}">Events </a></li>
   <li><a href="{{ url('gallery') }}">Gallery </a></li>
   @if($pageInfo->reservations_status=='Active')
   <li><a href="{{ url('reservation') }}">Reservation & Contact</a></li>
   @endif
  </ul>
</div><!-- .offcanvas-menu -->
</div><!-- .wrapper -->