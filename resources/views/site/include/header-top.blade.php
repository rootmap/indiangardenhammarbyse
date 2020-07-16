<div class="header-top">
   <div class="container">
      <div class="row">
         <div class="col-xs-12 hidden-xs col-sm-6">
            <!-- Top right side content -->
            <ul class="fa-ul list-inline top-info level-one">
               <li><a class="tel-no" href="tel:{{ $social->phone }}"><i class="fa fa-phone"></i> {{ $social->phone }}</a></li>
            </ul>
         </div>
         <!-- Top right side content top-nav -->
         <div class="col-xs-12 col-sm-6">

            <ul class="list-inline top-social level-one pull-right">
               <!-- <li style="color: #fff; ">Choose Language</li> -->
               
               <li class="location active"><a  class="sv-lang" href="#" style="color: #c79c60 !important;">SV </a></li>
               <li class="location"><a href="#" class="eng-lang">ENG </a></li>
            </ul>
            <ul class="list-inline top-social level-one pull-right" id="mobnavData">
               
               <li class="hidden-xs hidden-sm"><a href="{{ $social->instagram }}" target="_blank"><i class="fa fa-instagram"></i></a></li>
               <li class="hidden-xs hidden-sm"><a href="{{ $social->facebook }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
               <!-- <li><a href="#"><i class="fa fa-tripadvisor"></i></a></li> -->
               @if(isset(Auth::user()->user_type))
                  @if(Auth::user()->user_type==1)
                     <li id="profile" class="location"><i class="fa fa-user"></i> {{ Auth::user()->name }}</li>
                     <li id="logout" class="location"><i class="fa fa-lock"></i> Logout</li>
                  @else
                     <li id="login" class="location"><i class="fa fa-unlock"></i> Login</li>
                  @endif
               @else 
                  <li id="login" class="location"><i class="fa fa-unlock"></i> Login</li>
               @endif
            </ul>

            
            <!-- <div class="clearfix"></div> -->
         </div>
      </div>
   </div>
</div>