<!--  JAVASCRIPT -->
<script type="text/javascript" src="{{url('site/js/jquery.min.js')}}"></script> 
<!-- Modernizr JS --> 
<script type="text/javascript" src="{{url('site/js/modernizr-2.6.2.min.js')}}"></script>
<!--Bootatrap JS-->
<script type="text/javascript" src="{{url('site/js/bootstrap.min.js')}}"></script>
<!-- Animate js -->
<script type="text/javascript" src="{{url('site/js/wow.min.js')}}"></script>
<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="{{url('site/vendor/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
<script type="text/javascript" src="{{url('site/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
<!-- Fancy Box JS -->
<script type="text/javascript" src="{{url('site/vendor/fancybox/jquery.fancybox.min.js')}}"></script>
<!-- OWL CAROUSEL   -->
<script type="text/javascript" src="{{url('site/js/owl.carousel.min.js')}}"></script> 
<!-- Offcanvas -->
<script type="text/javascript" src="{{url('site/js/sidebarEffects.js')}}"></script>
<script type="text/javascript" src="{{url('site/js/classie.js')}}"></script>
<!-- Gallery Shuffle Js -->
<script type="text/javascript" src="{{url('site/js/jquery.shuffle.min.js')}}"></script>
<!-- jQuery UI -->
<script type="text/javascript" src="{{url('site/js/jquery-ui.min.js')}}"></script>
<!-- Validation -->
<script type="text/javascript" src="{{url('site/js/validation.js')}}"></script>
<!-- Tweetie JS  -->
{{-- <script type="text/javascript" src="{{url('site/js/tweetie.min.js')}}"></script> --}}
<!-- Google Map PopUp -->
{{-- <script type="text/javascript" src="{{url('site/js/map-popup.js')}}"></script> --}}
<!-- Css Preseter -->
<script type="text/javascript" src="{{url('site/js/preset.js')}}"></script>
<!-- Custom script --> 
<script type="text/javascript" src="{{url('site/js/custom.js')}}"></script>
<script src="{{url('site/js/jquery.timepicker.js')}}"></script>
<script>
  $(function() {
    $('#timepicker,#timepicker2').timepicker();
  });
</script>
<script type="text/javascript">
        $(function(){
  
          $('li.dropdown > a').on('click',function(event){
            
            event.preventDefault()
            
            $(this).parent().find('ul').first().toggle(300);
            
            $(this).parent().siblings().find('ul').hide(200);
            
            //Hide menu when clicked outside
            $(this).parent().find('ul').mouseleave(function(){  
              var thisUI = $(this);
              $('html').click(function(){
                thisUI.hide();
                $('html').unbind('click');
              });
            });
            
            
          });
          

         
          
        });
      </script>