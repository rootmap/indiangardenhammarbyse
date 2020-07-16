<?php

namespace App\Http\Controllers;

use App\SiteSettings;
use App\AdminLog;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Site Settings";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=SiteSettings::count();
        if($tabCount==0)
        {
            return redirect(url('sitesettings/create'));
        }else{

            $tab=SiteSettings::orderBy('id','DESC')->first();      
        return view('admin.pages.sitesettings.sitesettings_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=SiteSettings::count();
        if($tabCount==0)
        {            
        return view('admin.pages.sitesettings.sitesettings_create');
            
        }else{

            $tab=SiteSettings::orderBy('id','DESC')->first();      
        return view('admin.pages.sitesettings.sitesettings_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function SystemAdminLog($module_name="",$action="",$details=""){
        $tab=new AdminLog();
        $tab->module_name=$module_name;
        $tab->action=$action;
        $tab->details=$details;
        $tab->admin_id=$this->sdc->admin_id();
        $tab->admin_name=$this->sdc->UserName();
        $tab->save();
    }


    public function store(Request $request)
    {
        $this->validate($request,[
                
                'site_title'=>'required',
                'address'=>'required',
                'phone'=>'required',
                'email_address'=>'required',
        ]);

        $this->SystemAdminLog("Site Settings","Save New","Create New");

        

        $filename_sitesettings='';
        if ($request->hasFile('site_logo')) {
            $img_sitesettings = $request->file('site_logo');
            $upload_sitesettings = 'upload/sitesettings';
            $filename_sitesettings = time() . '.' . $img_sitesettings->getClientOriginalExtension();
            $img_sitesettings->move($upload_sitesettings, $filename_sitesettings);
        }

                
        $tab=new SiteSettings();
        
        $tab->site_title=$request->site_title;
        $tab->site_logo=$filename_sitesettings;
        $tab->address=$request->address;
        $tab->phone=$request->phone;
        $tab->email_address=$request->email_address;
        $tab->order_admin_email=$request->order_admin_email;
        $tab->reservation_admin_email=$request->reservation_admin_email;
        $tab->contact_map_source_url=$request->contact_map_source_url;
        $tab->save();

        return redirect('sitesettings')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'site_title'=>'required',
                'address'=>'required',
                'phone'=>'required',
                'email_address'=>'required',
        ]);

        $tab=new SiteSettings();
        
        $tab->site_title=$request->site_title;
        $tab->site_logo=$filename_sitesettings;
        $tab->address=$request->address;
        $tab->phone=$request->phone;
        $tab->email_address=$request->email_address;
        $tab->order_admin_email=$request->order_admin_email;
        $tab->reservation_admin_email=$request->reservation_admin_email;
        $tab->contact_map_source_url=$request->contact_map_source_url;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SiteSettings  $sitesettings
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('site_title','LIKE','%'.$search.'%');
                            $query->orWhere('site_logo','LIKE','%'.$search.'%');
                            $query->orWhere('address','LIKE','%'.$search.'%');
                            $query->orWhere('phone','LIKE','%'.$search.'%');
                            $query->orWhere('email_address','LIKE','%'.$search.'%');
                            $query->orWhere('order_admin_email','LIKE','%'.$search.'%');
                            $query->orWhere('reservation_admin_email','LIKE','%'.$search.'%');
                            $query->orWhere('contact_map_source_url','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })
                     ->count();
        return $tab;
    }


    private function methodToGetMembers($start, $length,$search=''){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('site_title','LIKE','%'.$search.'%');
                            $query->orWhere('site_logo','LIKE','%'.$search.'%');
                            $query->orWhere('address','LIKE','%'.$search.'%');
                            $query->orWhere('phone','LIKE','%'.$search.'%');
                            $query->orWhere('email_address','LIKE','%'.$search.'%');
                            $query->orWhere('order_admin_email','LIKE','%'.$search.'%');
                            $query->orWhere('reservation_admin_email','LIKE','%'.$search.'%');
                            $query->orWhere('contact_map_source_url','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })
                     ->skip($start)->take($length)->get();
        return $tab;
    }

    public function datatable(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->methodToGetMembersCount($search); // get your total no of data;
        $members = $this->methodToGetMembers($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    
    public function SiteSettingsQuery($request)
    {
        $SiteSettings_data=SiteSettings::orderBy('id','DESC')->get();

        return $SiteSettings_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Site Title','Site Logo','Address','Phone','Email Address','Order Admin Email','Reservation Admin Email','Contact MAP Source URL','Created Date');
        array_push($data, $array_column);
        $inv=$this->SiteSettingsQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->site_title,$voi->site_logo,$voi->address,$voi->phone,$voi->email_address,$voi->order_admin_email,$voi->reservation_admin_email,$voi->contact_map_source_url,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Site Settings Report',
            'report_title'=>'Site Settings Report',
            'report_description'=>'Report Genarated : '.$dataDateTimeIns,
            'data'=>$data
        );

        $this->sdc->ExcelLayout($excelArray);
        
    }

    public function ExportPDF(Request $request)
    {

        $html="<table class='table table-bordered' style='width:100%;'>
                <thead>
                <tr>
                <th class='text-center' style='font-size:12px;'>ID</th>
                            <th class='text-center' style='font-size:12px;' >Site Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Site Logo</th>
                        
                            <th class='text-center' style='font-size:12px;' >Address</th>
                        
                            <th class='text-center' style='font-size:12px;' >Phone</th>
                        
                            <th class='text-center' style='font-size:12px;' >Email Address</th>
                        
                            <th class='text-center' style='font-size:12px;' >Order Admin Email</th>
                        
                            <th class='text-center' style='font-size:12px;' >Reservation Admin Email</th>
                        
                            <th class='text-center' style='font-size:12px;' >Contact MAP Source URL</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->SiteSettingsQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->site_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->site_logo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->phone."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->email_address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->order_admin_email."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->reservation_admin_email."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->contact_map_source_url."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Site Settings Report',$html);


    }
    public function show(SiteSettings $sitesettings)
    {
        
        $tab=SiteSettings::all();return view('admin.pages.sitesettings.sitesettings_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SiteSettings  $sitesettings
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteSettings $sitesettings,$id=0)
    {
        $tab=SiteSettings::find($id);      
        return view('admin.pages.sitesettings.sitesettings_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SiteSettings  $sitesettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteSettings $sitesettings,$id=0)
    {
        $this->validate($request,[
                
                'site_title'=>'required',
                'address'=>'required',
                'phone'=>'required',
                'email_address'=>'required',
        ]);

        $this->SystemAdminLog("Site Settings","Update","Edit / Modify");

        

        $filename_sitesettings=$request->ex_site_logo;
        if ($request->hasFile('site_logo')) {
            $img_sitesettings = $request->file('site_logo');
            $upload_sitesettings = 'upload/sitesettings';
            $filename_sitesettings = time() . '.' . $img_sitesettings->getClientOriginalExtension();
            $img_sitesettings->move($upload_sitesettings, $filename_sitesettings);
        }

                
        $tab=SiteSettings::find($id);
        
        $tab->site_title=$request->site_title;
        $tab->site_logo=$filename_sitesettings;
        $tab->address=$request->address;
        $tab->phone=$request->phone;
        $tab->email_address=$request->email_address;
        $tab->order_admin_email=$request->order_admin_email;
        $tab->reservation_admin_email=$request->reservation_admin_email;
        $tab->contact_map_source_url=$request->contact_map_source_url;
        $tab->save();

        return redirect('sitesettings')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SiteSettings  $sitesettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteSettings $sitesettings,$id=0)
    {
        $this->SystemAdminLog("Site Settings","Destroy","Delete");

        $tab=SiteSettings::find($id);
        $tab->delete();
        return redirect('sitesettings')->with('status','Deleted Successfully !');}
}
