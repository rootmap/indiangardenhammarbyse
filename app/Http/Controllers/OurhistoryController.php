<?php

namespace App\Http\Controllers;

use App\OurHistory;
use App\AdminLog;
use Illuminate\Http\Request;

class OurHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Our History";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=OurHistory::all();
        return view('admin.pages.ourhistory.ourhistory_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.ourhistory.ourhistory_create');
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
                'content_image'=>'required',
                'content_detail'=>'required',
        ]);

        $this->SystemAdminLog("Our History","Save New","Create New");

        

        $filename_ourhistory_2='';
        if ($request->hasFile('content_image')) {
            $img_ourhistory = $request->file('content_image');
            $upload_ourhistory = 'upload/ourhistory';
            $filename_ourhistory_2 = time() . '.' . $img_ourhistory->getClientOriginalExtension();
            $img_ourhistory->move($upload_ourhistory, $filename_ourhistory_2);
        }

                
        $tab=new OurHistory();
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->content_image=$filename_ourhistory_2;
        $tab->content_detail=$request->content_detail;
        $tab->save();

        return redirect('ourhistory')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'sub_heading'=>'required',
                'content_image'=>'required',
                'content_detail'=>'required',
        ]);

        $tab=new OurHistory();
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->content_image=$filename_ourhistory_2;
        $tab->content_detail=$request->content_detail;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OurHistory  $ourhistory
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('heading','LIKE','%'.$search.'%');
                            $query->orWhere('sub_heading','LIKE','%'.$search.'%');
                            $query->orWhere('content_image','LIKE','%'.$search.'%');
                            $query->orWhere('content_detail','LIKE','%'.$search.'%');
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
                            $query->orWhere('content_image','LIKE','%'.$search.'%');
                            $query->orWhere('content_detail','LIKE','%'.$search.'%');
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

    
    public function OurHistoryQuery($request)
    {
        $OurHistory_data=OurHistory::orderBy('id','DESC')->get();

        return $OurHistory_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Heading','Sub Heading','Content Image','Content Detail','Created Date');
        array_push($data, $array_column);
        $inv=$this->OurHistoryQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->heading,$voi->sub_heading,$voi->content_image,$voi->content_detail,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Our History Report',
            'report_title'=>'Our History Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >Content Image</th>
                        
                            <th class='text-center' style='font-size:12px;' >Content Detail</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->OurHistoryQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->sub_heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->content_image."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->content_detail."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Our History Report',$html);


    }
    public function show(OurHistory $ourhistory)
    {
        
        $tab=OurHistory::all();return view('admin.pages.ourhistory.ourhistory_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OurHistory  $ourhistory
     * @return \Illuminate\Http\Response
     */
    public function edit(OurHistory $ourhistory,$id=0)
    {
        $tab=OurHistory::find($id);      
        return view('admin.pages.ourhistory.ourhistory_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OurHistory  $ourhistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OurHistory $ourhistory,$id=0)
    {
        $this->validate($request,[
                
                'heading'=>'required',
                'sub_heading'=>'required',
                'content_detail'=>'required',
        ]);

        $this->SystemAdminLog("Our History","Update","Edit / Modify");

        

        $filename_ourhistory_2=$request->ex_content_image;
        if ($request->hasFile('content_image')) {
            $img_ourhistory = $request->file('content_image');
            $upload_ourhistory = 'upload/ourhistory';
            $filename_ourhistory_2 = time() . '.' . $img_ourhistory->getClientOriginalExtension();
            $img_ourhistory->move($upload_ourhistory, $filename_ourhistory_2);
        }

                
        $tab=OurHistory::find($id);
        
        $tab->heading=$request->heading;
        $tab->sub_heading=$request->sub_heading;
        $tab->content_image=$filename_ourhistory_2;
        $tab->content_detail=$request->content_detail;
        $tab->save();

        return redirect('ourhistory')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OurHistory  $ourhistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurHistory $ourhistory,$id=0)
    {
        $this->SystemAdminLog("Our History","Destroy","Delete");

        $tab=OurHistory::find($id);
        $tab->delete();
        return redirect('ourhistory')->with('status','Deleted Successfully !');}
}
