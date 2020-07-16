<?php

namespace App\Http\Controllers;

use App\EventInfo;
use App\AdminLog;
use Illuminate\Http\Request;

class EventInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Event Info";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=EventInfo::all();
        return view('admin.pages.eventinfo.eventinfo_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.eventinfo.eventinfo_create');
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
                'content'=>'required',
                'content_image'=>'required',
                'content_attachment'=>'required',
                'event_expired'=>'required',
        ]);

        $this->SystemAdminLog("Event Info","Save New","Create New");

        

        $filename_eventinfo_3='';
        if ($request->hasFile('content_image')) {
            $img_eventinfo = $request->file('content_image');
            $upload_eventinfo = 'upload/eventinfo';
            $filename_eventinfo_3 = time() . '.' . $img_eventinfo->getClientOriginalExtension();
            $img_eventinfo->move($upload_eventinfo, $filename_eventinfo_3);
        }

                

        $filename_eventinfo_4='';
        if ($request->hasFile('content_attachment')) {
            $img_eventinfo = $request->file('content_attachment');
            $upload_eventinfo = 'upload/eventinfo';
            $filename_eventinfo_4 = time() . '.' . $img_eventinfo->getClientOriginalExtension();
            $img_eventinfo->move($upload_eventinfo, $filename_eventinfo_4);
        }

                
        $tab=new EventInfo();
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->content=$request->content;
        $tab->content_image=$filename_eventinfo_3;
        $tab->content_attachment=$filename_eventinfo_4;
        $tab->event_expired=$request->event_expired;
        $tab->save();

        return redirect('eventinfo')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'sub_heading'=>'required',
                'content'=>'required',
                'content_image'=>'required',
                'content_attachment'=>'required',
                'event_expired'=>'required',
        ]);

        $tab=new EventInfo();
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->content=$request->content;
        $tab->content_image=$filename_eventinfo_3;
        $tab->content_attachment=$filename_eventinfo_4;
        $tab->event_expired=$request->event_expired;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EventInfo  $eventinfo
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('heading','LIKE','%'.$search.'%');
                            $query->orWhere('sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('content','LIKE','%'.$search.'%');
                            $query->orWhere('content_image','LIKE','%'.$search.'%');
                            $query->orWhere('content_attachment','LIKE','%'.$search.'%');
                            $query->orWhere('event_expired','LIKE','%'.$search.'%');
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
                            $query->orWhere('content','LIKE','%'.$search.'%');
                            $query->orWhere('content_image','LIKE','%'.$search.'%');
                            $query->orWhere('content_attachment','LIKE','%'.$search.'%');
                            $query->orWhere('event_expired','LIKE','%'.$search.'%');
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

    
    public function EventInfoQuery($request)
    {
        $EventInfo_data=EventInfo::orderBy('id','DESC')->get();

        return $EventInfo_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Heading','Sub Heading','Content','Content Image','Content Attachment','Event Expired','Created Date');
        array_push($data, $array_column);
        $inv=$this->EventInfoQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->heading,$voi->sub_heading,$voi->content,$voi->content_image,$voi->content_attachment,$voi->event_expired,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Event Info Report',
            'report_title'=>'Event Info Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >Content</th>
                        
                            <th class='text-center' style='font-size:12px;' >Content Image</th>
                        
                            <th class='text-center' style='font-size:12px;' >Content Attachment</th>
                        
                            <th class='text-center' style='font-size:12px;' >Event Expired</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->EventInfoQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->sub_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->content."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->content_image."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->content_attachment."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->event_expired."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Event Info Report',$html);


    }
    public function show(EventInfo $eventinfo)
    {
        
        $tab=EventInfo::all();return view('admin.pages.eventinfo.eventinfo_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventInfo  $eventinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(EventInfo $eventinfo,$id=0)
    {
        $tab=EventInfo::find($id);      
        return view('admin.pages.eventinfo.eventinfo_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventInfo  $eventinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventInfo $eventinfo,$id=0)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'sub_heading'=>'required',
                'content'=>'required',
                'event_expired'=>'required',
        ]);

        $this->SystemAdminLog("Event Info","Update","Edit / Modify");

        

        $filename_eventinfo_3=$request->ex_content_image;
        if ($request->hasFile('content_image')) {
            $img_eventinfo = $request->file('content_image');
            $upload_eventinfo = 'upload/eventinfo';
            $filename_eventinfo_3 = time() . '.' . $img_eventinfo->getClientOriginalExtension();
            $img_eventinfo->move($upload_eventinfo, $filename_eventinfo_3);
        }

                

        $filename_eventinfo_4=$request->ex_content_attachment;
        if ($request->hasFile('content_attachment')) {
            $img_eventinfo = $request->file('content_attachment');
            $upload_eventinfo = 'upload/eventinfo';
            $filename_eventinfo_4 = time() . '.' . $img_eventinfo->getClientOriginalExtension();
            $img_eventinfo->move($upload_eventinfo, $filename_eventinfo_4);
        }

                
        $tab=EventInfo::find($id);
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->content=$request->content;
        $tab->content_image=$filename_eventinfo_3;
        $tab->content_attachment=$filename_eventinfo_4;
        $tab->event_expired=$request->event_expired;
        $tab->save();

        return redirect('eventinfo')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventInfo  $eventinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventInfo $eventinfo,$id=0)
    {
        $this->SystemAdminLog("Event Info","Destroy","Delete");

        $tab=EventInfo::find($id);
        $tab->delete();
        return redirect('eventinfo')->with('status','Deleted Successfully !');}
}
