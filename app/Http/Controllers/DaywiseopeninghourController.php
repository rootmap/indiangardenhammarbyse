<?php

namespace App\Http\Controllers;

use App\DayWiseOpeningHour;
use App\AdminLog;
use Illuminate\Http\Request;

class DayWiseOpeningHourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Day Wise Opening Hour";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=DayWiseOpeningHour::all();
        return view('admin.pages.daywiseopeninghour.daywiseopeninghour_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.daywiseopeninghour.daywiseopeninghour_create');
    }

    public function loadDate(Request $request)
    {
        $dayName=date('l',strtotime($request->dateText));
        $tab=DayWiseOpeningHour::where('day_name',$dayName)->orderBy('opeing_hour','ASC')->get();
        return Response()->json($tab);
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
                
                'day_name'=>'required',
                'opeing_hour'=>'required',
                'time_status'=>'required',
        ]);

        $this->SystemAdminLog("Day Wise Opening Hour","Save New","Create New");

        
        $tab=new DayWiseOpeningHour();
        
        $tab->day_name=$request->day_name;
        $tab->opeing_hour=$request->opeing_hour;
        $tab->time_status=$request->time_status;
        $tab->save();

        return redirect('daywiseopeninghour')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'day_name'=>'required',
                'opeing_hour'=>'required',
                'time_status'=>'required',
        ]);

        $tab=new DayWiseOpeningHour();
        
        $tab->day_name=$request->day_name;
        $tab->opeing_hour=$request->opeing_hour;
        $tab->time_status=$request->time_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DayWiseOpeningHour  $daywiseopeninghour
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('day_name','LIKE','%'.$search.'%');
                            $query->orWhere('opeing_hour','LIKE','%'.$search.'%');
                            $query->orWhere('time_status','LIKE','%'.$search.'%');
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
                            $query->orWhere('day_name','LIKE','%'.$search.'%');
                            $query->orWhere('opeing_hour','LIKE','%'.$search.'%');
                            $query->orWhere('time_status','LIKE','%'.$search.'%');
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

    
    public function DayWiseOpeningHourQuery($request)
    {
        $DayWiseOpeningHour_data=DayWiseOpeningHour::orderBy('id','DESC')->get();

        return $DayWiseOpeningHour_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Day Name','Opeing Hour','Time Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->DayWiseOpeningHourQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->day_name,$voi->opeing_hour,$voi->time_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Day Wise Opening Hour Report',
            'report_title'=>'Day Wise Opening Hour Report',
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
                            <th class='text-center' style='font-size:12px;' >Day Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Opeing Hour</th>
                        
                            <th class='text-center' style='font-size:12px;' >Time Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->DayWiseOpeningHourQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->day_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->opeing_hour."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->time_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Day Wise Opening Hour Report',$html);


    }
    public function show(DayWiseOpeningHour $daywiseopeninghour)
    {
        
        $tab=DayWiseOpeningHour::all();return view('admin.pages.daywiseopeninghour.daywiseopeninghour_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DayWiseOpeningHour  $daywiseopeninghour
     * @return \Illuminate\Http\Response
     */
    public function edit(DayWiseOpeningHour $daywiseopeninghour,$id=0)
    {
        $tab=DayWiseOpeningHour::find($id);      
        return view('admin.pages.daywiseopeninghour.daywiseopeninghour_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DayWiseOpeningHour  $daywiseopeninghour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DayWiseOpeningHour $daywiseopeninghour,$id=0)
    {
        $this->validate($request,[
                
                'day_name'=>'required',
                'opeing_hour'=>'required',
                'time_status'=>'required',
        ]);

        $this->SystemAdminLog("Day Wise Opening Hour","Update","Edit / Modify");

        
        $tab=DayWiseOpeningHour::find($id);
        
        $tab->day_name=$request->day_name;
        $tab->opeing_hour=$request->opeing_hour;
        $tab->time_status=$request->time_status;
        $tab->save();

        return redirect('daywiseopeninghour')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DayWiseOpeningHour  $daywiseopeninghour
     * @return \Illuminate\Http\Response
     */
    public function destroy(DayWiseOpeningHour $daywiseopeninghour,$id=0)
    {
        $this->SystemAdminLog("Day Wise Opening Hour","Destroy","Delete");

        $tab=DayWiseOpeningHour::find($id);
        $tab->delete();
        return redirect('daywiseopeninghour')->with('status','Deleted Successfully !');}
}
