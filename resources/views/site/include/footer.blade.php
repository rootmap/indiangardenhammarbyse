<footer class="" style="background: url({{URL::asset('upload/websitesettings/'.$social->footer_image)}}); background-size: cover;">
   <div class="footer-top control-overlay">
    <div class="container">
      <div class="row rellax" data-rellax-speed="0">
        <div class="col-xs-12 col-sm-6 col-md-3" style="display: none;">
          <h3 class="footer-title">MY ACCOUNT</h3>
          <ul class="list-unstyled">
            <li><a href="{{url('my-account')}}">My Account</a></li>
            <li><a href="{{url('order-history')}}">Order History</a></li>
            <li><a href="{{url('wishlist')}}">Wishlist</a></li>
            <li><a href="{{url('newsletter')}}">Newsletter</a></li>
            <li><a href="{{url('my-reservation')}}">My Reservation</a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3" style="display: none;">
          <h3 class="footer-title">INFORMATION</h3>
          <ul class="list-unstyled">
            <li><a href="{{url('about-us')}}">About us</a></li>
            <li><a href="{{url('delivery-information')}}">Delivery Information</a></li>
            <li><a href="{{url('reservation')}}">Contact us</a></li>
            <li><a href="{{url('terms-condition')}}">Terms & Conditions</a></li>
            <li><a href="{{url('sitemap')}}">Sitemap</a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
          <h3 class="footer-title">opening hour</h3>
          <div class="open-time opening-time">
            @if(!empty($OpeningHour))
            @foreach($OpeningHour as $opening)

            <?php 
            $class ='';
              /*if($opening->day_status=="Closed"){
                $class ='class="clock-time"';
              }
              else{
                $class ='';
              }*/
            ?>
             <p <?= $class?>>
               <strong>{{$opening->day_name}} :</strong> {{$opening->opening_and_closing_hour}}
             </p>

             @endforeach
           @endif
         </div>
       </div>
       
       <div class="col-xs-12 col-sm-6 col-md-3">
         <h3 class="footer-title">contacts</h3>
         <div class="address">
           <p class="icon-map"><i class="fa fa-map-marker"></i> <strong>address :</strong>  {{ $social->address }} </p>
           <p><i class="fa fa-phone"></i> <strong>phone :</strong> <a href="tel:{{ $social->phone }}">{{ $social->phone }}</a></p>
           <p><i class="fa fa-envelope"></i> <strong>email :</strong><a href="mailto:{{ $social->email_address }}"> {{ $social->email_address }}</a></p>
         </div>
         <ul class="list-inline footer-social-list">
          <li><a  target="_blank" href="{{ $social->twitter }}"><i class="flaticon-twitter1"></i></a></li>
          <li><a  target="_blank" href="{{ $social->facebook }}"><i class="flaticon-facebook55"></i></a></li>
          <li><a  target="_blank" href="{{ $social->linkin }}"><i class="flaticon-linkedin11"></i></a></li>
          <li><a  target="_blank" href="{{ $social->pinterest }}"><i class="flaticon-pinterest34"></i></a></li>
        </ul>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-6">
         <iframe id="fotterAMap" src="{{ $social->contact_map_source_url }}" width="100%" frameborder="0" style="border:0; height: 250px;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </div>

      
    </div>
  </div>
</div>
<div class="footer-bottom">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="copy-right pull-left">
          <p>Copyright-{{date('Y')}} Indian graden</p>
        </div>
        
        <div class="back-top pull-right">
          <i class="fa {{ $social->bottom_icon }} "></i>
        </div>
      </div>
    </div>
  </div>
</div>
</footer>