<div class="popup-section"  id="signUPArea" style="background:url({{url('images/bgtffive.png')}}) repeat; background: rgb(255,255,255,0.95); position: fixed;">
    <div class="row">
      <div class="col-md-12">
        <a href="javascript:void(0);"  
        class="cross"
        style="font-size: 50px; text-align: right; padding-right: 20px; padding-top: 20px; text-decoration: none; color: #a87f41; display: block; right:30px; top:10px; cursor: pointer;">&times;</a>
        <div class="col-md-6 col-md-offset-3" id="logsignupreg" style="padding-top:5%;">
            <div class="col-md-12 mb-1" style="font-family: Arial,Helvetica,sans-serif; color: #a87f41; text-align: center; font-weight: bolder; font-size: 60px; text-transform: uppercase; display: block; height:40px;">Sign Up</div>

            <div class="col-md-8 mb-1 col-md-offset-2">
                <div class="col-md-12">
                     <p class="text-divider"><span>Please Enter Signup Info</span></p>
                </div>
            </div>

            <div class="col-md-8  col-md-offset-2">
                <div class="col-md-12">
                     <div class="form-group">
                      <label style="font-weight: 600;">Full Name</label>
                      <input  style="border-radius: 0px;" id="fullname_signup" name="fullname_signup" class="form-control form-control-lg" type="text" placeholder="Enter Full Name">
                    </div>
                </div>
            </div>

            <div class="col-md-8  col-md-offset-2">
                <div class="col-md-12">
                     <div class="form-group">
                      <label style="font-weight: 600;">Email Address</label>
                      <input style="border-radius: 0px;" id="email_signup" name="email_signup" class="form-control form-control-lg" type="text" placeholder="Enter Email Address">
                    </div>
                </div>
            </div>
            <div class="col-md-8  col-md-offset-2">
                <div class="col-md-12">
                     <div class="form-group">
                      <label style="font-weight: 600;">Password</label>
                      <input  style="border-radius: 0px;" id="password_signup" name="password_signup" class="form-control form-control-lg" type="password" placeholder="Enter Password">
                    </div>
                </div>
            </div>



            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-12">
                     <a style="text-decoration: none; color: #a87f41; font-weight:500; display: block; text-align: right;" class="newlogIn" href="javascript:void(0);">
                        I already have an account. Login ?
                      </a>
                </div>
            </div>

            <div class="col-md-8 mb-1 col-md-offset-2">
                <div class="col-md-12">
                     <button class="btn btn-info registerc" type="button">
                        <i class="fa fa-unlock" aria-hidden="true"></i> Register 
                      </button>
                </div>
            </div>

            <div class="col-md-8 mb-1 col-md-offset-2">
                <div class="col-md-12">
                     <p class="text-divider"><span>Or Signup With Social </span></p>
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
</div>