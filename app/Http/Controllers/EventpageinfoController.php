<?php

namespace App\Http\Controllers;

use App\EventPageInfo;
use App\AdminLog;
use Illuminate\Http\Request;

class EventPageInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Event Page Info";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=EventPageInfo::count();
        if($tabCount==0)
        {
            return redirect(url('eventpageinfo/create'));
        }else{

            $tab=EventPageInfo::orderBy('id','DESC')->first();      
        return view('admin.pages.eventpageinfo.eventpageinfo_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=EventPageInfo::count();
        if($tabCount==0)
        {            
        return view('admin.pages.eventpageinfo.eventpageinfo_create');
            
        }else{

            $tab=EventPageInfo::orderBy('id','DESC')->first();      
        return view('admin.pages.eventpageinfo.eventpageinfo_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                
                'page_heading'=>'required',
                'content_heading'=>'required',
                'content_sub_heading'=>'required',
                'content_description'=>'required',
                'content_background'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Event Page Info","Save New","Create New");

        

        $filename_eventpageinfo_4='';
        if ($request->hasFile('content_background')) {
            $img_eventpageinfo = $request->file('content_background');
            $upload_eventpageinfo = 'upload/eventpageinfo';
            $filename_eventpageinfo_4 = time() . '.' . $img_eventpageinfo->getClientOriginalExtension();
            $img_eventpageinfo->move($upload_eventpageinfo, $filename_eventpageinfo_4);
        }

                
        $tab=new EventPageInfo();
        
        $tab->page_heading=$request->page_heading;
        $tab->content_heading=$request->content_heading;
        $tab->content_sub_heading=$request->content_sub_heading;
        $tab->content_description=$request->content_description;
        $tab->content_background=$filename_eventpageinfo_4;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('eventpageinfo')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'page_heading'=>'required',
                'content_heading'=>'required',
                'content_sub_heading'=>'required',
                'content_description'=>'required',
                'content_background'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new EventPageInfo();
        
        $tab->page_heading=$request->page_heading;
        $tab->content_heading=$request->content_heading;
        $tab->content_sub_heading=$request->content_sub_heading;
        $tab->content_description=$request->content_description;
        $tab->content_background=$filename_eventpageinfo_4;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EventPageInfo  $eventpageinfo
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('page_heading','LIKE','%'.$search.'%');
                            $query->orWhere('content_heading','LIKE','%'.$search.'%');
                            $query->orWhere('content_sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('content_description','LIKE','%'.$search.'%');
                            $query->orWhere('content_background','LIKE','%'.$search.'%');
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
                            $query->orWhere('page_heading','LIKE','%'.$search.'%');
                            $query->orWhere('content_heading','LIKE','%'.$search.'%');
                            $query->orWhere('content_sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('content_description','LIKE','%'.$search.'%');
                            $query->orWhere('content_background','LIKE','%'.$search.'%');
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

    
    public function EventPageInfoQuery($request)
    {
        $EventPageInfo_data=EventPageInfo::orderBy('id','DESC')->get();

        return $EventPageInfo_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Page Heading','Content Heading','Content Sub Heading','Content Description','Content Background','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->EventPageInfoQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->page_heading,$voi->content_heading,$voi->content_sub_heading,$voi->content_description,$voi->content_background,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Event Page Info Report',
            'report_title'=>'Event Page Info Report',
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
                            <th class='text-center' style='font-size:12px;' >Page Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >Content Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >Content Sub Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >Content Description</th>
                        
                            <th class='text-center' style='font-size:12px;' >Content Background</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->EventPageInfoQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->page_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->content_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->content_sub_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->content_description."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->content_background."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Event Page Info Report',$html);


    }
    public function show(EventPageInfo $eventpageinfo)
    {
        
        $tab=EventPageInfo::all();return view('admin.pages.eventpageinfo.eventpageinfo_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventPageInfo  $eventpageinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(EventPageInfo $eventpageinfo,$id=0)
    {
        $tab=EventPageInfo::find($id);      
        return view('admin.pages.eventpageinfo.eventpageinfo_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventPageInfo  $eventpageinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventPageInfo $eventpageinfo,$id=0)
    {
        $this->validate($request,[
                
                'page_heading'=>'required',
                'content_heading'=>'required',
                'content_sub_heading'=>'required',
                'content_description'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Event Page Info","Update","Edit / Modify");

        

        $filename_eventpageinfo_4=$request->ex_content_background;
        if ($request->hasFile('content_background')) {
            $img_eventpageinfo = $request->file('content_background');
            $upload_eventpageinfo = 'upload/eventpageinfo';
            $filename_eventpageinfo_4 = time() . '.' . $img_eventpageinfo->getClientOriginalExtension();
            $img_eventpageinfo->move($upload_eventpageinfo, $filename_eventpageinfo_4);
        }

                
        $tab=EventPageInfo::find($id);
        
        $tab->page_heading=$request->page_heading;
        $tab->content_heading=$request->content_heading;
        $tab->content_sub_heading=$request->content_sub_heading;
        $tab->content_description=$request->content_description;
        $tab->content_background=$filename_eventpageinfo_4;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('eventpageinfo')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventPageInfo  $eventpageinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventPageInfo $eventpageinfo,$id=0)
    {
        $this->SystemAdminLog("Event Page Info","Destroy","Delete");

        $tab=EventPageInfo::find($id);
        $tab->delete();
        return redirect('eventpageinfo')->with('status','Deleted Successfully !');}
}
