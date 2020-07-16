<?php

namespace App\Http\Controllers;

use App\WebsiteSettings;
use App\AdminLog;
use Illuminate\Http\Request;

class WebsiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Website Settings";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=WebsiteSettings::count();
        if($tabCount==0)
        {
            return redirect(url('websitesettings/create'));
        }else{

            $tab=WebsiteSettings::orderBy('id','DESC')->first();      
        return view('admin.pages.websitesettings.websitesettings_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=WebsiteSettings::count();
        if($tabCount==0)
        {            
        return view('admin.pages.websitesettings.websitesettings_create');
            
        }else{

            $tab=WebsiteSettings::orderBy('id','DESC')->first();      
        return view('admin.pages.websitesettings.websitesettings_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                
        ]);

        $this->SystemAdminLog("Website Settings","Save New","Create New");

        

        $filename_websitesettings_2='';
        if ($request->hasFile('footer_image')) {
            $img_websitesettings = $request->file('footer_image');
            $upload_websitesettings = 'upload/websitesettings';
            $filename_websitesettings_2 = time() . '.' . $img_websitesettings->getClientOriginalExtension();
            $img_websitesettings->move($upload_websitesettings, $filename_websitesettings_2);
        }

                
        $tab=new WebsiteSettings();
        
        $tab->website_meta_data=$request->website_meta_data;
        $tab->website_meta_description=$request->website_meta_description;
        $tab->footer_image=$filename_websitesettings_2;
        $tab->bottom_icon=$request->bottom_icon;
        $tab->book_table_button_content=$request->book_table_button_content;
        $tab->overlay=$request->overlay;
        $tab->save();

        return redirect('websitesettings')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
        ]);

        $tab=new WebsiteSettings();
        
        $tab->website_meta_data=$request->website_meta_data;
        $tab->website_meta_description=$request->website_meta_description;
        $tab->footer_image=$filename_websitesettings_2;
        $tab->bottom_icon=$request->bottom_icon;
        $tab->book_table_button_content=$request->book_table_button_content;
        $tab->overlay=$request->overlay;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WebsiteSettings  $websitesettings
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('website_meta_data','LIKE','%'.$search.'%');
                            $query->orWhere('website_meta_description','LIKE','%'.$search.'%');
                            $query->orWhere('footer_image','LIKE','%'.$search.'%');
                            $query->orWhere('bottom_icon','LIKE','%'.$search.'%');
                            $query->orWhere('book_table_button_content','LIKE','%'.$search.'%');
                            $query->orWhere('overlay','LIKE','%'.$search.'%');
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
                            $query->orWhere('website_meta_data','LIKE','%'.$search.'%');
                            $query->orWhere('website_meta_description','LIKE','%'.$search.'%');
                            $query->orWhere('footer_image','LIKE','%'.$search.'%');
                            $query->orWhere('bottom_icon','LIKE','%'.$search.'%');
                            $query->orWhere('book_table_button_content','LIKE','%'.$search.'%');
                            $query->orWhere('overlay','LIKE','%'.$search.'%');
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

    
    public function WebsiteSettingsQuery($request)
    {
        $WebsiteSettings_data=WebsiteSettings::orderBy('id','DESC')->get();

        return $WebsiteSettings_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Website Meta Data','Website Meta Description','Footer Image','Bottom Icon','Book Table Button Content','Overlay','Created Date');
        array_push($data, $array_column);
        $inv=$this->WebsiteSettingsQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->website_meta_data,$voi->website_meta_description,$voi->footer_image,$voi->bottom_icon,$voi->book_table_button_content,$voi->overlay,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Website Settings Report',
            'report_title'=>'Website Settings Report',
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
                            <th class='text-center' style='font-size:12px;' >Website Meta Data</th>
                        
                            <th class='text-center' style='font-size:12px;' >Website Meta Description</th>
                        
                            <th class='text-center' style='font-size:12px;' >Footer Image</th>
                        
                            <th class='text-center' style='font-size:12px;' >Bottom Icon</th>
                        
                            <th class='text-center' style='font-size:12px;' >Book Table Button Content</th>
                        
                            <th class='text-center' style='font-size:12px;' >Overlay</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->WebsiteSettingsQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->website_meta_data."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->website_meta_description."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->footer_image."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->bottom_icon."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->book_table_button_content."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->overlay."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Website Settings Report',$html);


    }
    public function show(WebsiteSettings $websitesettings)
    {
        
        $tab=WebsiteSettings::all();return view('admin.pages.websitesettings.websitesettings_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WebsiteSettings  $websitesettings
     * @return \Illuminate\Http\Response
     */
    public function edit(WebsiteSettings $websitesettings,$id=0)
    {
        $tab=WebsiteSettings::find($id);      
        return view('admin.pages.websitesettings.websitesettings_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WebsiteSettings  $websitesettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebsiteSettings $websitesettings,$id=0)
    {
        $this->validate($request,[
                
        ]);

        $this->SystemAdminLog("Website Settings","Update","Edit / Modify");

        

        $filename_websitesettings_2=$request->ex_footer_image;
        if ($request->hasFile('footer_image')) {
            $img_websitesettings = $request->file('footer_image');
            $upload_websitesettings = 'upload/websitesettings';
            $filename_websitesettings_2 = time() . '.' . $img_websitesettings->getClientOriginalExtension();
            $img_websitesettings->move($upload_websitesettings, $filename_websitesettings_2);
        }

                
        $tab=WebsiteSettings::find($id);
        
        $tab->website_meta_data=$request->website_meta_data;
        $tab->website_meta_description=$request->website_meta_description;
        $tab->footer_image=$filename_websitesettings_2;
        $tab->bottom_icon=$request->bottom_icon;
        $tab->book_table_button_content=$request->book_table_button_content;
        $tab->overlay=$request->overlay;
        $tab->save();

        return redirect('websitesettings')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WebsiteSettings  $websitesettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebsiteSettings $websitesettings,$id=0)
    {
        $this->SystemAdminLog("Website Settings","Destroy","Delete");

        $tab=WebsiteSettings::find($id);
        $tab->delete();
        return redirect('websitesettings')->with('status','Deleted Successfully !');}
}
