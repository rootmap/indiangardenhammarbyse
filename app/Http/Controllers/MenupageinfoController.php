<?php

namespace App\Http\Controllers;

use App\MenuPageInfo;
use App\AdminLog;
use Illuminate\Http\Request;

class MenuPageInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Menu Page Info";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=MenuPageInfo::count();
        if($tabCount==0)
        {
            return redirect(url('menupageinfo/create'));
        }else{

            $tab=MenuPageInfo::orderBy('id','DESC')->first();      
        return view('admin.pages.menupageinfo.menupageinfo_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=MenuPageInfo::count();
        if($tabCount==0)
        {            
        return view('admin.pages.menupageinfo.menupageinfo_create');
            
        }else{

            $tab=MenuPageInfo::orderBy('id','DESC')->first();      
        return view('admin.pages.menupageinfo.menupageinfo_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                
                'heading'=>'required',
                'sub_heading'=>'required',
                'header_image'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Menu Page Info","Save New","Create New");

        

        $filename_menupageinfo_2='';
        if ($request->hasFile('header_image')) {
            $img_menupageinfo = $request->file('header_image');
            $upload_menupageinfo = 'upload/menupageinfo';
            $filename_menupageinfo_2 = time() . '.' . $img_menupageinfo->getClientOriginalExtension();
            $img_menupageinfo->move($upload_menupageinfo, $filename_menupageinfo_2);
        }

                
        $tab=new MenuPageInfo();
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->header_image=$filename_menupageinfo_2;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('menupageinfo')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'sub_heading'=>'required',
                'header_image'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new MenuPageInfo();
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->header_image=$filename_menupageinfo_2;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuPageInfo  $menupageinfo
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('heading','LIKE','%'.$search.'%');
                            $query->orWhere('sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('header_image','LIKE','%'.$search.'%');
                            $query->orWhere('module_status','LIKE','%'.$search.'%');
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
                            $query->orWhere('heading','LIKE','%'.$search.'%');
                            $query->orWhere('sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('header_image','LIKE','%'.$search.'%');
                            $query->orWhere('module_status','LIKE','%'.$search.'%');
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

    
    public function MenuPageInfoQuery($request)
    {
        $MenuPageInfo_data=MenuPageInfo::orderBy('id','DESC')->get();

        return $MenuPageInfo_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Heading','Sub Heading','Header Image','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->MenuPageInfoQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->heading,$voi->sub_heading,$voi->header_image,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Menu Page Info Report',
            'report_title'=>'Menu Page Info Report',
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
                            <th class='text-center' style='font-size:12px;' >Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >Sub Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >Header Image</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->MenuPageInfoQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->sub_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->header_image."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Menu Page Info Report',$html);


    }
    public function show(MenuPageInfo $menupageinfo)
    {
        
        $tab=MenuPageInfo::all();return view('admin.pages.menupageinfo.menupageinfo_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuPageInfo  $menupageinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuPageInfo $menupageinfo,$id=0)
    {
        $tab=MenuPageInfo::find($id);      
        return view('admin.pages.menupageinfo.menupageinfo_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuPageInfo  $menupageinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuPageInfo $menupageinfo,$id=0)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'sub_heading'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Menu Page Info","Update","Edit / Modify");

        

        $filename_menupageinfo_2=$request->ex_header_image;
        if ($request->hasFile('header_image')) {
            $img_menupageinfo = $request->file('header_image');
            $upload_menupageinfo = 'upload/menupageinfo';
            $filename_menupageinfo_2 = time() . '.' . $img_menupageinfo->getClientOriginalExtension();
            $img_menupageinfo->move($upload_menupageinfo, $filename_menupageinfo_2);
        }

        $filename_download_lunch_menu=$request->ex_download_lunch_menu;
        if ($request->hasFile('download_lunch_menu')) {
            $img_download_lunch_menu = $request->file('download_lunch_menu');
            $upload_menupageinfo = 'upload/menupageinfo';
            $filename_download_lunch_menu = time() . '.' . $img_download_lunch_menu->getClientOriginalExtension();
            $img_download_lunch_menu->move($upload_menupageinfo, $filename_download_lunch_menu);
        }

                
        $tab=MenuPageInfo::find($id);
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->header_image=$filename_menupageinfo_2;
        $tab->module_status=$request->module_status;
        $tab->download_lunch_menu=$filename_download_lunch_menu;
        $tab->save();

        return redirect('menupageinfo')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuPageInfo  $menupageinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuPageInfo $menupageinfo,$id=0)
    {
        $this->SystemAdminLog("Menu Page Info","Destroy","Delete");

        $tab=MenuPageInfo::find($id);
        $tab->delete();
        return redirect('menupageinfo')->with('status','Deleted Successfully !');}
}
