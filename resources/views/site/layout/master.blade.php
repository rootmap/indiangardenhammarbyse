<?php 
   $sdc = new CoreCustomController();
   $pageInfo=$sdc->menuInfo();
   $social=$sdc->socialLink();
?>
<!DOCTYPE HTML>
<html lang="en" class="no-js">
   <head>
      <!-- Basic -->
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      
      <title>@yield('title') | Indian Garden</title>
      @include('site.include.headerCss')
      @yield('css')
      <style type="text/css">
       .control-overlay {
           background: 0% 0% / cover rgba(0,0,0, 0.5);
       }
     </style>

   </head>
   <body onload="initialize()">
      <div class="loader"></div>
      <!--===| Search Start |===-->
      @include('site.include.search')
      <!--===| Search End |===-->
      <!--===| Pop Up Google Map Start |===-->
      @include('site.include.login')
      @include('site.include.signup')
      @include('site.include.reset')
      <!--===| Pop Up Google Map End |===-->
      <!--===| Header Top Start |===-->
      <div id="offcanvas-container" class="wrapper offcanvas-container">
         <div class="inner-wrapper offcanvas-pusher">
            @include('site.include.header-top')
            <!--===| Header Top End |===-->
            @include('site.include.logo-menu')
            <!-- /header-wrapper -->    
             @yield('content')
            @include('site.include.reservation')
            <!--====| Footer section Start|====-->
            @include('site.include.footer')
            <!--==| Footer section End|==-->
         </div>
         <!--==| .inner-wrapper |=core/indiangardenhammarbyse    digimo_indiangardenhammarbyse ,reG~o7D{DJR     digimo_frontend=-->
         @include('site.include.mobile_menu')
      </div>
      <!-- .wrapper -->
      @include('site.include.footerJs')
      
      <script src="{{url('rellax/rellax.min.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
      <script>
        // Accepts any class name
        
      </script>
      @yield('js')
      <script type="text/javascript">

         var isMobile = {
              Android: function() {
                  return navigator.userAgent.match(/Android/i);
              },
              BlackBerry: function() {
                  return navigator.userAgent.match(/BlackBerry/i);
              },
              iOS: function() {
                  return navigator.userAgent.match(/iPhone|iPad|iPod/i);
              },
              Opera: function() {
                  return navigator.userAgent.match(/Opera Mini/i);
              },
              Windows: function() {
                  return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
              },
              any: function() {
                  return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
              }
          };

          if( isMobile.any() )
          {
            $('.home_video').css('min-height','400px');
            //$('#playVidemomo').css('height','249px !important');
            $('#playVidemomo').find('img').css('margin-top',($('#ifvemo').height()*23/100)+'px');
          }else{
            var rellax = new Rellax('.rellax');

          }

          console.log('header-wrapper=',$('.header-wrapper').height());
          var logoFIxHeight=$('.header-wrapper').height()-3;
          $("#logo").attr('style','height:'+logoFIxHeight+'px !important; margin-top:4px;');

          $( window ).resize(function() {
              console.log('header-wrapper=',$('.header-wrapper').height());
              var logoFIxHeight=$('.header-wrapper').height()-3;
              $("#logo").attr('style','height:'+logoFIxHeight+'px !important; margin-top:4px;');
          });

          $(document).ready(function(){
              $('input[name=reservations_date]').change(function(){
                  var reservations_date=$(this).val();
                  

                  if(reservations_date.length>0)
                  {
                      $("select[name=reservations_time]").html("");
                      var selHtml='<option value="00:00">Loading...</option>';
                      $("#res_reservations_time").html(selHtml);
                      var loadDate="{{url('daywiseopeninghour/loaddate')}}";
                      var selHtml='';
                          selHtml+='<option value="">Select Time</option>';
                           $("select[name=reservations_time]").html(selHtml);
                      $.post(loadDate,{'dateText':reservations_date,'_token':'{{csrf_token()}}'},function(reData){
                          
                          $.each(reData,function(k,row){
                              var selHtml='<option value="'+row.opeing_hour+'">'+row.opeing_hour+'</option>';
                              console.log(row.opeing_hour);
                              $("select[name=reservations_time]").append(selHtml);
                          });
                          
                      });
                     

                      console.log('res Date',reservations_date);
                  }
                  else
                  {
                      console.log(reservations_date);
                  }

              });
          });

          $(document).ready(function(){

            $(".addMorePerson").click(function(){
                var personPopAreaIn=$("#personPopAreaIn").val();
                var personPopAreaInTOT=(personPopAreaIn-0)+(1-0);
                $("#personPopAreaIn").val(personPopAreaInTOT)
            });

            $(".minusMorePerson").click(function(){
                var personPopAreaIn=$("#personPopAreaIn").val();
                if(personPopAreaIn<=0)
                {
                  $("#personPopAreaIn").val(0);
                }
                else
                {
                    var personPopAreaInTOT=(personPopAreaIn-1);
                    $("#personPopAreaIn").val(personPopAreaInTOT);
                }
                
            });

            $("#personPopAreaIn").keyup(function(){
                var personPopAreaIn=$("#personPopAreaIn").val();
                if(personPopAreaIn<=0)
                {
                  $("#personPopAreaIn").val(0);
                }
                else
                {
                    $("#personPopAreaIn").val(personPopAreaIn);
                }
            });

             $("#personPopAreaIn").change(function(){
                var personPopAreaIn=$("#personPopAreaIn").val();
                if(personPopAreaIn<=0)
                {
                  $("#personPopAreaIn").val(0);
                }
                else
                {
                    $("#personPopAreaIn").val(personPopAreaIn);
                }
            });

             $(".addMorePersonres").click(function(){
                var personPopAreaIn=$("#respersonPopAreaIn").val();
                var personPopAreaInTOT=(personPopAreaIn-0)+(1-0);
                $("#respersonPopAreaIn").val(personPopAreaInTOT)
            });

            $(".minusMorePersonres").click(function(){
                var personPopAreaIn=$("#respersonPopAreaIn").val();
                if(personPopAreaIn<=0)
                {
                  $("#respersonPopAreaIn").val(0);
                }
                else
                {
                    var personPopAreaInTOT=(personPopAreaIn-1);
                    $("#respersonPopAreaIn").val(personPopAreaInTOT);
                }
                
            });

            $("#respersonPopAreaIn").keyup(function(){
                var personPopAreaIn=$("#respersonPopAreaIn").val();
                if(personPopAreaIn<=0)
                {
                  $("#respersonPopAreaIn").val(0);
                }
                else
                {
                    $("#respersonPopAreaIn").val(personPopAreaIn);
                }
            });

             $("#respersonPopAreaIn").change(function(){
                var personPopAreaIn=$("#respersonPopAreaIn").val();
                if(personPopAreaIn<=0)
                {
                  $("#respersonPopAreaIn").val(0);
                }
                else
                {
                    $("#respersonPopAreaIn").val(personPopAreaIn);
                }
            });

             $("#profile").click(function(){
                window.location.href="{{ url('user/dashboard') }}";
             });

             $("#logout").click(function(){
                  Swal.showLoading();
                  $(".swal2-container").css('z-index',99999);
                  var logincustomer="{{url('logoutMember')}}";
                  $.ajax({
                      'async': false,
                      'type': "POST",
                      'global': false,
                      'dataType': 'json',
                      'url': logincustomer,
                      'data':{'_token':'{{csrf_token()}}'},
                      'success': function (data) {
                          
                                  window.location.href="{{ url('/') }}";
            
                      }
                  });


                  return false;
              });

              $("#loginsubmit").click(function(){

                  var email_login=$("input[name=email_login]").val();
                  var password_login=$("input[name=password_login]").val();

                  if(email_login.length==0)
                  {
                      swal({
                        title: "Warning",
                        text: "Email address required!",
                        icon: "error",
                        button: "Ok",
                      });

                      return false;
                  }

                  if(password_login.length==0)
                  {
                      swal({
                        title: "Warning",
                        text: "Password required!",
                        icon: "error",
                        button: "Ok",
                      });

                      return false;
                  }

                  $(this).html('<i class="fa fa-unlock" aria-hidden="true"></i> Login <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');

                  var logincustomer="{{url('customer/login')}}";

                  $.ajax({
                      'async': false,
                      'type': "POST",
                      'global': false,
                      'dataType': 'json',
                      'url': logincustomer,
                      'data':{'email':email_login,'password':password_login,'_token':'{{csrf_token()}}'},
                      'success': function (data) {
                          if(data.status==1)
                            {
                              Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Login complete, Redirecting please wait...',
                                showConfirmButton: false,
                                timer: 3500
                              });
                              $(".swal2-container").css('z-index',99999);

                              setTimeout(function(){
                                  window.location.href="{{url('user/dashboard')}}";
                              },3500);
                            } 
                            else
                            {

                              Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.msg
                              });
                              $(".swal2-container").css('z-index',99999);
                            }
                      }
                  });


                  return false;
              });

             $(".registerc").click(function(){

                  var fullname_signup=$("input[name=fullname_signup]").val();
                  var email_signup=$("input[name=email_signup]").val();
                  var password_signup=$("input[name=password_signup]").val();

                  if(fullname_signup.length==0)
                  {
                      swal({
                        title: "Warning",
                        text: "Full Name required!",
                        icon: "error",
                        button: "Ok",
                      });

                      return false;
                  }
                  
                  if(email_signup.length==0)
                  {
                      swal({
                        title: "Warning",
                        text: "Email address required!",
                        icon: "error",
                        button: "Ok",
                      });

                      return false;
                  }

                  if(password_signup.length==0)
                  {
                      swal({
                        title: "Warning",
                        text: "Password required!",
                        icon: "error",
                        button: "Ok",
                      });

                      return false;
                  }

                  $(this).html('<i class="fa fa-unlock" aria-hidden="true"></i> Register <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');

                  var logincustomer="{{url('customer/register')}}";

                  $.ajax({
                      'async': true,
                      'type': "POST",
                      'global': true,
                      'dataType': 'json',
                      'url': logincustomer,
                      'data':{'fullname':fullname_signup,'email':email_signup,'password':password_signup,'_token':'{{csrf_token()}}'},
                      'success': function (data) {
                            if(data.status==0)
                            {
                              Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Registration completed, Redirecting please wait...',
                                showConfirmButton: false,
                                timer: 3500
                              });
                              $(".swal2-container").css('z-index',99999);

                              setTimeout(function(){
                                  window.location.href="{{url('user/dashboard')}}";
                              },3500);
                            } 
                            else
                            {

                              Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.msg
                              });
                              $(".swal2-container").css('z-index',99999);
                            }
                          
                      }
                  });


                  return false;

             });
          });

          

          if( isMobile.any() )
          { 
            $("#logsignup").attr("style","padding-top:0px;"); 
            $(".font-5-slider").attr("style","position: absolute; left: 0px; right: 0px; font-size:17px;"); 
            
            $("#mobnavData").removeClass("pull-right"); 
            $("#mobnavData").addClass("pull-left"); 
          }
          else
          { 
            $("#logsignup").attr("style","padding-top:7%;");
            $(".font-5-slider").attr("style","position: absolute; left: 0px; right: 0px; font-size:48px;");  
            $("#mobnavData").addClass("pull-right"); 
            $("#mobnavData").removeClass("pull-left"); 
          }

          $("#logsignupexit").click(function(){
              $("#loginArea").fadeOut('slow');
          });




      </script>
      @if(Session::has('success'))
        <script type="text/javascript">
          Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: '{{ Session::get('success') }}',
                  showConfirmButton: false,
                  timer: 3500
              });
              $(".swal2-container").css('z-index',99999);
        </script>
      @endif

      @if(Session::has('error'))
        <script type="text/javascript">
          Swal.fire({
                  icon: 'warning',
                  title: 'Warning',
                  text: '{{ Session::get('error') }}',
                  showConfirmButton: false,
                  timer: 3500
              });
              $(".swal2-container").css('z-index',99999);
        </script>
      @endif

      @if (count($errors) > 0)
         <?php $dataConeCat=''; ?>
           @foreach ($errors->all() as $error)
           <?php 
           if(!empty($dataConeCat))
           {
            $dataConeCat.=','; 
           }

           $dataConeCat.=$error; 

           ?>
          @endforeach
          <script type="text/javascript">
          Swal.fire({
                  icon: 'warning',
                  title: 'Warning',
                  text: '{{ $dataConeCat }}',
                  showConfirmButton: false,
                  timer: 3500
              });
              $(".swal2-container").css('z-index',99999);
        </script>
      @endif
      <!--Start of Tawk.to Script-->
      <script type="text/javascript">
      $(document).ready(function(){

          //$(".typewriter").hide().show("slide", { direction: "left" }, 1500);


          var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
          (function(){
          var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
          s1.async=true;
          s1.src='https://embed.tawk.to/5e4f9c25298c395d1ce90fdd/default';
          s1.charset='UTF-8';
          s1.setAttribute('crossorigin','*');
          s0.parentNode.insertBefore(s1,s0);
          })();

 /*         .theme-background-color {
    background-color: #03a84e;
}*/

      });
      
      </script>
      <!--End of Tawk.to Script-->
   </body>
</html>