<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\SiteSettings;
use App\Slider;
use App\WeAreOpen;
use App\HomePageVideo;
use App\HomeOrderDelivery;
use App\HomeDelivery;
use App\OpeningHour;
use App\OurHistoryPageInfo;
use App\OurHistory;
use App\Category;
use App\MenuPageInfo;
use App\MenuItem;
use App\EventPageInfo;
use App\EventInfo;
use App\Gallery;
use App\ReservationsRequest;
use App\SocialLinkMgt;
use App\ContactUsRequest;
use App\WebsiteSettings;
use App\Reservation;
use App\Blogs;
use App\Customer;
use App\GalleryCategory;
class IndexController extends Controller
{

    private $moduleName="Our History";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }

    public function adminIndex(){
    	return view('admin.pages.index');
    }
    public function adminTable(){
    	return view('admin.pages.tables');
    }

    private function categoryParseData()
    {
        $data=[];
        $pureCatCheck=Category::count();

        if($pureCatCheck > 0 )
        {
            $pureCat=Category::where('category_status','=','Active')->get();
            foreach($pureCat as $pc){
                $sCatCheck=MenuItem::where('category',$pc->id)->count();
                $subCatData=[];
                if($sCatCheck > 0)
                {
                    $sCat=MenuItem::where('category',$pc->id)->get();
                    foreach($sCat as $sc)
                    {
                        $subCatData[]=[
                            'id'=>$sc->id,
                            'name'=>$sc->name,
                            'description'=>$sc->description,
                            'price'=>$sc->price,
                            'menu_item_image'=>$sc->menu_item_image,
                            'special'=>$sc->special,
                            'spicy'=>$sc->spicy
                        ];
                    }
                }
                $data[]=[
                        'id'=>$pc->id,
                        'name'=>$pc->name,
                        'description'=>$pc->description,
                        'scat'=>$subCatData
                    ];
            }
        }

        return $data;
    }
    
    public function index(){
        
        $slider                 = Slider::all();
        $HomePageVideo          = HomePageVideo::all();
        $we_are_open            = WeAreOpen::all();
        $HomeOrderDelivery      = HomeOrderDelivery::first();
        $HomeDelivery           = HomeDelivery::first();
        $OpeningHour            = OpeningHour::all();
        
        //dd($SocialLinkMgt);
        return view('site.pages.index',[
            
            'slider'=>$slider,
            'HomePageVideo'=>$HomePageVideo,
            'we_are_open'=>$we_are_open,
            'HomeOrderDelivery'=>$HomeOrderDelivery,
            'HomeDelivery'=>$HomeDelivery,
            'OpeningHour'=>$OpeningHour,
            
        ]);
    }
    public function ourHistory(){
        $setting        = Sitesettings::all();
        $history        = OurHistoryPageInfo::where('module_status','=','Active')->get();
        $OurHistory     = OurHistory::all();
        $OpeningHour    = OpeningHour::all();
        $WebsiteSettings        = WebsiteSettings::first();
        $SocialLinkMgt          = SocialLinkMgt::first();
    	return view('site.pages.our-history',[
            'setting'=>$setting,
            'history'=>$history,
            'OurHistory'=>$OurHistory,
            'OpeningHour'=>$OpeningHour,
            'WebsiteSettings'=>$WebsiteSettings,
            'SocialLinkMgt'=>$SocialLinkMgt
        ]);
    }
    
    public function menu(){
        
        $OpeningHour    = OpeningHour::all();
        $MenuPageInfo   = MenuPageInfo::where('module_status','=','Active')->get();
        $MenuItem       = $this->categoryParseData();
        $category        = Category::where('category_status','Active')->get();
        
        //dd($MenuItem);
    	return view('site.pages.menu',[
            'OpeningHour'=>$OpeningHour,
            'MenuPageInfo'=>$MenuPageInfo,
            'MenuItem'=>$MenuItem,
            'category'=>$category,
        ]);
    }
    public function event(){
        $setting        = Sitesettings::all();
        $OpeningHour    = OpeningHour::all();
        $EventPageInfo  = EventPageInfo::where('module_status','=','Active')->first();
        $EventInfo    = EventInfo::where('event_expired','=','Yes')->get();
        $WebsiteSettings        = WebsiteSettings::first();
        $SocialLinkMgt          = SocialLinkMgt::first();
        //dd($EventPageInfo);
    	return view('site.pages.events',[
            'setting'=>$setting,
            'OpeningHour'=>$OpeningHour,
            'EventPageInfo'=>$EventPageInfo,
            'EventInfo'=>$EventInfo,
            'WebsiteSettings'=>$WebsiteSettings,
            'SocialLinkMgt'=>$SocialLinkMgt
        ]);
    }
    public function gallery(){
        $OpeningHour    = OpeningHour::all();
        $gallery        = Gallery::simplePaginate(36);
        $category        = GalleryCategory::where('category_status','Active')->get();
        
    	return view('site.pages.gallery',[
            
            'OpeningHour'=>$OpeningHour,
            'gallery'=>$gallery,
            'category'=>$category,
           
        ]);
    }
    public function reservation(){
        $setting        = Sitesettings::all();
        $OpeningHour    = OpeningHour::all();
        $WebsiteSettings        = WebsiteSettings::first();
        $SocialLinkMgt          = SocialLinkMgt::first();
        $Reservation          = Reservation::first();
    	return view('site.pages.reservation',[
            'setting'=>$setting,
            'OpeningHour'=>$OpeningHour,
            'WebsiteSettings'=>$WebsiteSettings,
            'SocialLinkMgt'=>$SocialLinkMgt,
            'reservation'=>$Reservation
        ]);
    }
    public function blog(){
        $setting        = Sitesettings::all();
        $OpeningHour    = OpeningHour::all();
        $WebsiteSettings        = WebsiteSettings::first();
        $SocialLinkMgt          = SocialLinkMgt::first();
        return view('site.pages.blog',[
            'setting'=>$setting,
            'OpeningHour'=>$OpeningHour,
            'WebsiteSettings'=>$WebsiteSettings,
            'SocialLinkMgt'=>$SocialLinkMgt
        ]);
    }
    public function blogDetail(){
        $setting        = Sitesettings::all();
        $OpeningHour    = OpeningHour::all();
        $WebsiteSettings        = WebsiteSettings::first();
        $SocialLinkMgt          = SocialLinkMgt::first();
        return view('site.pages.blog_detail',[
            'setting'=>$setting,
            'OpeningHour'=>$OpeningHour,
            'WebsiteSettings'=>$WebsiteSettings,
            'SocialLinkMgt'=>$SocialLinkMgt
        ]);
    }
    
    public function reservationStore(Request $request)
    {
        // if($_SERVER['REMOTE_ADDR']=="103.57.42.222")
        // {
        //      dd($request);
        // }
       
        $this->validate($request,[
                
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'reservations_date'=>'required',
                'reservations_time'=>'required',
                'person'=>'required',
        ]);

        
        $tab=new ReservationsRequest();
        
        $tab->name=$request->name;
        $tab->email=$request->email;
        $tab->reservations_date=$request->reservations_date;
        $tab->reservations_time=$request->reservations_time;
        $tab->person=$request->person." Person";
        $tab->reservations_status=$request->reservations_status;
        $tab->save();

        $emailDetail=$this->reservationEmailTemplate($request);

        $SiteSettings=SiteSettings::first();

        //dd();

        $this->sdc->initMail(
            $SiteSettings->reservation_admin_email,
            'Reservation Request',
            $emailDetail,
            'This is the body in plain text for non-HTML mail clients'
        );

        
        return redirect()->back()->with('success', 'Your Booking has been sent successfully.');

    }

    private function reservationEmailTemplate($request)
    {


        $html='
        <!doctype html>
        <html>
          <head>
            <meta name="viewport" content="width=device-width">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Simple Transactional Email</title>
            <style>
            /* -------------------------------------
                INLINED WITH htmlemail.io/inline
            ------------------------------------- */
            /* -------------------------------------
                RESPONSIVE AND MOBILE FRIENDLY STYLES
            ------------------------------------- */
            @media only screen and (max-width: 620px) {
              table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
              }
              table[class=body] p,
                    table[class=body] ul,
                    table[class=body] ol,
                    table[class=body] td,
                    table[class=body] span,
                    table[class=body] a {
                font-size: 16px !important;
              }
              table[class=body] .wrapper,
                    table[class=body] .article {
                padding: 10px !important;
              }
              table[class=body] .content {
                padding: 0 !important;
              }
              table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
              }
              table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
              }
              table[class=body] .btn table {
                width: 100% !important;
              }
              table[class=body] .btn a {
                width: 100% !important;
              }
              table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
              }
            }

            /* -------------------------------------
                PRESERVE THESE STYLES IN THE HEAD
            ------------------------------------- */
            @media all {
              .ExternalClass {
                width: 100%;
              }
              .ExternalClass,
                    .ExternalClass p,
                    .ExternalClass span,
                    .ExternalClass font,
                    .ExternalClass td,
                    .ExternalClass div {
                line-height: 100%;
              }
              .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
              }
              #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
              }
            }
            </style>
          </head>
          <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
            <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
              <tr>
                <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
                <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
                  <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>
                    <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                        <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                          <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                            <tr>
                              <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Dear Concern,</p>
                                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Reservation request has been raised from site, please check below info and response in your earliest posible time.</p>
                                <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                                  <tbody>
                                    <tr>
                                        <td>
                                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td width="150"><b>Name </b></td>
                                                        <td>'.$request->name.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Email</b> </td>
                                                        <td>'.$request->email.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Phone</b> </td>
                                                        <td>'.$request->phone.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Reservation Date</b> </td>
                                                        <td>'.$request->reservations_date.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Reservation Time</b> </td>
                                                        <td>'.$request->reservations_time.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Reserve For</b> </td>
                                                        <td>'.$request->person.' Person</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                      <td align="center" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                          <tbody>
                                            <tr>
                                              <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="mailto:'.$request->email.'" target="_blank" style="margin:0 auto; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Reply Requester</a> </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                                
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>

                    <!-- END MAIN CONTENT AREA -->
                    </table>

                    <!-- START FOOTER -->
                    <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
                      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                        <tr>
                          <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                            Powered by <a href="'.url('home').'" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">Indian Garden Norrköping</a>.
                          </td>
                        </tr>
                      </table>
                    </div>
                    <!-- END FOOTER -->

                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                </td>
                <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
              </tr>
            </table>
          </body>
        </html>';

        return $html;
    }




    public function contactStore(Request $request)
    {
        $this->validate($request,[
                
                'name'=>'required',
                'email'=>'required',
                'subject'=>'required',
                'message'=>'required',
                'contact_status'=>'required',
        ]);

        
        
        $tab=new ContactUsRequest();
        
        $tab->name=$request->name;
        $tab->email=$request->email;
        $tab->subject=$request->subject;
        $tab->message=$request->message;
        $tab->contact_status=$request->contact_status;
        $tab->save();

        $emailDetail=$this->contactEmailTemplate($request);

        $SiteSettings=SiteSettings::first();

        //dd();

        $this->sdc->initMail(
            $SiteSettings->email_address,
            'Contact Request',
            $emailDetail,
            'This is the body in plain text for non-HTML mail clients'
        );

        

        return redirect()->back()->with('success', 'Your message has been sent successfully.');

    }

    private function contactEmailTemplate($request)
    {


        $html='
        <!doctype html>
        <html>
          <head>
            <meta name="viewport" content="width=device-width">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Simple Transactional Email</title>
            <style>
            /* -------------------------------------
                INLINED WITH htmlemail.io/inline
            ------------------------------------- */
            /* -------------------------------------
                RESPONSIVE AND MOBILE FRIENDLY STYLES
            ------------------------------------- */
            @media only screen and (max-width: 620px) {
              table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
              }
              table[class=body] p,
                    table[class=body] ul,
                    table[class=body] ol,
                    table[class=body] td,
                    table[class=body] span,
                    table[class=body] a {
                font-size: 16px !important;
              }
              table[class=body] .wrapper,
                    table[class=body] .article {
                padding: 10px !important;
              }
              table[class=body] .content {
                padding: 0 !important;
              }
              table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
              }
              table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
              }
              table[class=body] .btn table {
                width: 100% !important;
              }
              table[class=body] .btn a {
                width: 100% !important;
              }
              table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
              }
            }

            /* -------------------------------------
                PRESERVE THESE STYLES IN THE HEAD
            ------------------------------------- */
            @media all {
              .ExternalClass {
                width: 100%;
              }
              .ExternalClass,
                    .ExternalClass p,
                    .ExternalClass span,
                    .ExternalClass font,
                    .ExternalClass td,
                    .ExternalClass div {
                line-height: 100%;
              }
              .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
              }
              #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
              }
            }
            </style>
          </head>
          <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
            <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
              <tr>
                <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
                <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
                  <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>
                    <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                        <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                          <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                            <tr>
                              <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Dear Concern,</p>
                                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Contact request has been raised from site, please check below info and response in your earliest posible time.</p>
                                <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                                  <tbody>
                                    <tr>
                                        <td>
                                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td width="100"><b>Name </b></td>
                                                        <td>'.$request->name.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Email</b> </td>
                                                        <td>'.$request->email.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Subject</b> </td>
                                                        <td>'.$request->subject.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Message</b> </td>
                                                        <td>'.$request->message.'</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                      <td align="center" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                          <tbody>
                                            <tr>
                                              <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="mailto:'.$request->email.'" target="_blank" style="margin:0 auto; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Reply Requester</a> </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                                
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>

                    <!-- END MAIN CONTENT AREA -->
                    </table>

                    <!-- START FOOTER -->
                    <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
                      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                        <tr>
                          <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                            Powered by <a href="'.url('home').'" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">Indian Garden Norrköping</a>.
                          </td>
                        </tr>
                      </table>
                    </div>
                    <!-- END FOOTER -->

                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                </td>
                <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
              </tr>
            </table>
          </body>
        </html>';

        return $html;
    }

    public function dashboard(){
        return view('admin.pages.dashboard.index');
    }
      public function userDashboard(){
        $OpeningHour    = OpeningHour::all();
        return view('site.pages.user_dashboard.index',[
            'OpeningHour'=>$OpeningHour,
        ]);
        
    }

    public function saveProfile(Request $request){
        //dd($request);

        \DB::beginTransaction();
        try {
            $tab=Customer::where('email_address',\Auth::user()->email)->first();
            $tab->name=$request->fullname;
            $tab->gander=$request->gander;
            $tab->date_of_birth=$request->date_of_birth;
            $tab->save();

            \DB::table('users')->where('email',\Auth::user()->email)->update([
                'name'=>$request->fullname
            ]);

            \DB::commit();

            return redirect('user/profile')->with('success','Profile updated successfully.');

        } catch (\Exception $e) {
            \DB::rollback();
            return redirect('user/profile')->with('error','Profile update failed. Please try again.');
        }

    }

    public function changeStorePassword(Request $request){
        //dd($request);

        if(empty($request->old_password))
        {
            return redirect('user/change-password')->with('error','Current password Required.!!!');
        }
        elseif(empty($request->password))
        {
            return redirect('user/change-password')->with('error','Password Required.!!!');
        }
        elseif(empty($request->retype_password))
        {
            return redirect('user/change-password')->with('error','Re-Type Password Required.!!!');
        }
        elseif($request->retype_password!=$request->password)
        {
            return redirect('user/change-password')->with('error','Re-Type Password Mismatch.!!!');
        }

        \DB::beginTransaction();
        try {
            $chk=Customer::where('email_address',\Auth::user()->email)->where('password',$request->old_password)->count();

            if($chk==1)
            {
                $tab=Customer::where('email_address',\Auth::user()->email)->first();
                $tab->password=$request->password;
                $tab->save();

                \DB::table('users')->where('email',\Auth::user()->email)->update([
                    'password'=>\Hash::make($request->password)
                ]);

                \DB::commit();

                return redirect('user/change-password')->with('success','Password change successful.');
            }
            else
            {
                return redirect('user/change-password')->with('error','Current password mismatch.!!!');
            }

            

        } catch (\Exception $e) {
            \DB::rollback();
            return redirect('user/change-password')->with('error','Password change failed. Please try again.');
        }

    }

    public function userProfile(){
        
        $OpeningHour    = OpeningHour::all();
        $userInfo=Customer::find(\Auth::user()->customer_id);
        //dd($userInfo);
        return view('site.pages.user_dashboard.profile',[
            
            'OpeningHour'=>$OpeningHour,
            'userInfo'=>$userInfo,
            
        ]);
        
    }

    public function changePassword(){
        $setting        = Sitesettings::all();
        $OpeningHour    = OpeningHour::all();
        $WebsiteSettings        = WebsiteSettings::first();
        $SocialLinkMgt          = SocialLinkMgt::first();
        return view('site.pages.user_dashboard.change-password',[
            'setting'=>$setting,
            'OpeningHour'=>$OpeningHour,
            'WebsiteSettings'=>$WebsiteSettings,
            'SocialLinkMgt'=>$SocialLinkMgt
        ]);
        
    }
    
    public function orderPaid(){
        $setting        = Sitesettings::all();
        $OpeningHour    = OpeningHour::all();
        $WebsiteSettings        = WebsiteSettings::first();
        $SocialLinkMgt          = SocialLinkMgt::first();
        return view('site.pages.user_dashboard.order-paid',[
            'setting'=>$setting,
            'OpeningHour'=>$OpeningHour,
            'WebsiteSettings'=>$WebsiteSettings,
            'SocialLinkMgt'=>$SocialLinkMgt
        ]);
        
    }
}
