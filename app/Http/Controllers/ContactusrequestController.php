<?php

namespace App\Http\Controllers;

use App\ContactUsRequest;
use App\AdminLog;
use Illuminate\Http\Request;

class ContactUsRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Contact Us Request";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=ContactUsRequest::all();
        return view('admin.pages.contactusrequest.contactusrequest_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.contactusrequest.contactusrequest_create');
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
                
                'name'=>'required',
                'email'=>'required',
                'subject'=>'required',
                'message'=>'required',
                'contact_status'=>'required',
        ]);

        $this->SystemAdminLog("Contact Us Request","Save New","Create New");

        
        $tab=new ContactUsRequest();
        
        $tab->name=$request->name;
        $tab->email=$request->email;
        $tab->subject=$request->subject;
        $tab->message=$request->message;
        $tab->contact_status=$request->contact_status;
        $tab->save();

        return redirect('contactusrequest')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
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

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactUsRequest  $contactusrequest
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('email','LIKE','%'.$search.'%');
                            $query->orWhere('subject','LIKE','%'.$search.'%');
                            $query->orWhere('message','LIKE','%'.$search.'%');
                            $query->orWhere('contact_status','LIKE','%'.$search.'%');
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
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('email','LIKE','%'.$search.'%');
                            $query->orWhere('subject','LIKE','%'.$search.'%');
                            $query->orWhere('message','LIKE','%'.$search.'%');
                            $query->orWhere('contact_status','LIKE','%'.$search.'%');
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

    
    public function ContactUsRequestQuery($request)
    {
        $ContactUsRequest_data=ContactUsRequest::orderBy('id','DESC')->get();

        return $ContactUsRequest_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Name','Email','Subject','Message','Contact Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->ContactUsRequestQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->name,$voi->email,$voi->subject,$voi->message,$voi->contact_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Contact Us Request Report',
            'report_title'=>'Contact Us Request Report',
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
                            <th class='text-center' style='font-size:12px;' >Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Email</th>
                        
                            <th class='text-center' style='font-size:12px;' >Subject</th>
                        
                            <th class='text-center' style='font-size:12px;' >Message</th>
                        
                            <th class='text-center' style='font-size:12px;' >Contact Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->ContactUsRequestQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->email."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->subject."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->message."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->contact_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Contact Us Request Report',$html);


    }
    public function show(ContactUsRequest $contactusrequest)
    {
        
        $tab=ContactUsRequest::all();return view('admin.pages.contactusrequest.contactusrequest_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactUsRequest  $contactusrequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUsRequest $contactusrequest,$id=0)
    {
        $tab=ContactUsRequest::find($id);      
        return view('admin.pages.contactusrequest.contactusrequest_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactUsRequest  $contactusrequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUsRequest $contactusrequest,$id=0)
    {
        $this->validate($request,[
                
                'name'=>'required',
                'email'=>'required',
                'subject'=>'required',
                'message'=>'required',
                'contact_status'=>'required',
        ]);

        $this->SystemAdminLog("Contact Us Request","Update","Edit / Modify");

        
        $tab=ContactUsRequest::find($id);
        
        $tab->name=$request->name;
        $tab->email=$request->email;
        $tab->subject=$request->subject;
        $tab->message=$request->message;
        $tab->contact_status=$request->contact_status;
        $tab->save();

        return redirect('contactusrequest')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactUsRequest  $contactusrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUsRequest $contactusrequest,$id=0)
    {
        $this->SystemAdminLog("Contact Us Request","Destroy","Delete");

        $tab=ContactUsRequest::find($id);
        $tab->delete();
        return redirect('contactusrequest')->with('status','Deleted Successfully !');}
}
