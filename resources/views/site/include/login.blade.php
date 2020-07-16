<style type="text/css">
  .text-divider{margin:5px 0; line-height: 0; text-align: center;}
.text-divider span{background-color: #fff; padding:8px; }
.text-divider:before{ content: " "; display: block; border-top: 1px solid #a87f41; border-bottom: 1px solid #a87f41;}
</style>
<div class="popup-section" id="loginArea" style="background:url({{url('images/bgtffive.png')}}) repeat; background: rgb(255,255,255,0.95); position: fixed;">
  <form action="javascript:void(0);" method="POST">
    <div class="row">
      <div class="col-md-12">
        <a href="javascript:void(0);"  
        class="cross" 
        style="font-size: 50px; text-align: right; padding-right: 20px; padding-top: 20px; text-decoration: none; color: #a87f41; display: block; right:30px; top:10px; cursor: pointer;">&times;</a>
        <div class="col-md-6 col-md-offset-3" id="logsignup" style="padding-top:7%;">
            <div class="col-md-12" style="font-family: Arial,Helvetica,sans-serif; color: #a87f41; text-align: center; font-weight: bolder; font-size: 60px; text-transform: uppercase; display: block; height:40px;">Log In</div>
            <div   class="col-md-12 mb-1" style="font: normal normal normal 15px/1.4em sans-serif;
    font-size: 18px;
    margin-right: 4px;
    margin-left: 4px; display: block; text-align: center; padding-top:10px; padding-bottom:10px; clear: both; display: block;">New to this site? <a href="javascript:void();" class="newSignip" style="text-decoration: none; color:#a87f41; ">SIGN UP</a></div>

            <div class="col-md-8 mb-1 col-md-offset-2">
                <div class="col-md-12">
                     <p class="text-divider"><span>Please Enter Credentials</span></p>
                </div>
            </div>
            <div class="col-md-8  col-md-offset-2">
                <div class="col-md-12">
                     <div class="form-group">
                      <label style="font-weight: 600;">Email Address</label>
                      <input style="border-radius: 0px;" id="email_login" name="email_login" class="form-control form-control-lg" type="text" placeholder="Enter Email Address">
                    </div>
                </div>
            </div>
            <div class="col-md-8  col-md-offset-2">
                <div class="col-md-12">
                     <div class="form-group">
                      <label style="font-weight: 600;">Password</label>
                      <input  style="border-radius: 0px;" id="password_login" name="password_login" class="form-control form-control-lg" type="password" placeholder="Enter Password">
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-12">
                     <a style="text-decoration: none; color: #a87f41; font-weight:500; display: block; text-align: right;" href="javascript:void(0);" class="reset">
                        I Forgot My password. Reset Now?
                      </a>
                </div>
            </div>

            <div class="col-md-8 mb-1 col-md-offset-2">
                <div class="col-md-12">
                     <button id="loginsubmit" class="btn btn-info" type="button">
                        <i class="fa fa-unlock" aria-hidden="true"></i> Login 
                      </button>
                </div>
            </div>

            <div class="col-md-8 mb-1 col-md-offset-2">
                <div class="col-md-12">
                     <p class="text-divider"><span>Or Login With Social </span></p>
                </div>
            </div>

            <div class="col-md-8  col-md-offset-2">
                <div class="col-md-6 col-sm-6 col-xs-6">
                     <a href="{{url('login/facebook')}}" class="btn btn-info" style="background-color: #3b5998;">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook 
                      </a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    
                    <a href="{{url('login/google')}}" class="btn btn-info" style="background-color: #4285f4;">
                      <i class="fa fa-google-plus-square" aria-hidden="true"></i> Google
                    </a>

                </div>
            </div>

            

        </div>
      </div>
    </div>
  </form>
</div>